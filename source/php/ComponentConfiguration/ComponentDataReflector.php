<?php

declare(strict_types=1);

namespace ComponentLibrary\ComponentConfiguration;

use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

/**
 * Reflects typed component data objects into runtime-friendly metadata.
 */
class ComponentDataReflector
{
    /**
     * @var array<string, array<string, string>>
     */
    private array $importCache = [];

    /**
     * Returns the reflected contract keyed by constructor parameter name.
     *
     * @param string $dataClass The typed data object class name.
     * @return array<string, array<string, mixed>>
     */
    public function getPropertyDefinitions(string $dataClass): array
    {
        $reflectionClass = new ReflectionClass($dataClass);
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor instanceof ReflectionMethod) {
            return [];
        }

        $collectionTypes = $this->getCollectionTypes($constructor);
        $collectionClasses = $this->getCollectionClasses($constructor);
        $definitions = [];

        foreach ($constructor->getParameters() as $parameter) {
            $types = $this->getTypes($parameter);
            $name = $parameter->getName();
            $hasDefault = $parameter->isDefaultValueAvailable();

            $definitions[$name] = [
                'name' => $name,
                'type' => implode('|', $types),
                'types' => $types,
                'required' => !$parameter->isOptional(),
                'hasDefault' => $hasDefault,
                'default' => $hasDefault ? $parameter->getDefaultValue() : null,
                'collectionType' => $collectionTypes[$name] ?? null,
                'collectionClass' => $collectionClasses[$name] ?? null,
            ];
        }

        return $definitions;
    }

    /**
     * Returns legacy default arguments derived from typed constructor defaults.
     *
     * @param string $dataClass The typed data object class name.
     * @return array<string, mixed>
     */
    public function getDefaultArguments(string $dataClass): array
    {
        $defaults = [];

        foreach ($this->getPropertyDefinitions($dataClass) as $name => $definition) {
            if ($definition['hasDefault'] !== true) {
                continue;
            }

            $defaults[$name] = $definition['default'];
        }

        return $defaults;
    }

    /**
     * Returns legacy argument type strings derived from typed constructor params.
     *
     * @param string $dataClass The typed data object class name.
     * @return array<string, string>
     */
    public function getArgumentTypes(string $dataClass): array
    {
        $types = [];

        foreach ($this->getPropertyDefinitions($dataClass) as $name => $definition) {
            $types[$name] = $definition['type'];
        }

        return $types;
    }

    /**
     * Returns collection element types declared in the constructor docblock.
     *
     * @param ReflectionMethod $constructor The reflected constructor.
     * @return array<string, string>
     */
    private function getCollectionTypes(ReflectionMethod $constructor): array
    {
        return array_map(
            fn (string $value): string => $this->getShortClassName($value),
            $this->getCollectionClasses($constructor)
        );
    }

    /**
     * Returns collection element class names declared in the constructor docblock.
     *
     * @param ReflectionMethod $constructor The reflected constructor.
     * @return array<string, string>
     */
    private function getCollectionClasses(ReflectionMethod $constructor): array
    {
        $docComment = $constructor->getDocComment();

        if (!is_string($docComment) || $docComment === '') {
            return [];
        }

        preg_match_all('/^[ \t]*\*\s*@param\s+(.+?)\s+\$([^\s]+)/m', $docComment, $matches, PREG_SET_ORDER);

        $collectionTypes = [];

        foreach ($matches as $match) {
            $declaredType = $this->normalizeCollectionDeclaration($match[1]);
            $parameterName = $match[2];

            if ($declaredType === null || substr($declaredType, -2) !== '[]') {
                continue;
            }

            $collectionType = substr($declaredType, 0, -2);
            $collectionTypes[$parameterName] = $this->resolveDocblockClassName(
                $collectionType,
                $constructor
            );
        }

        return $collectionTypes;
    }

    /**
     * Returns normalized type names for a reflected constructor parameter.
     *
     * @param ReflectionParameter $parameter The reflected parameter.
     * @return array<int, string>
     */
    private function getTypes(ReflectionParameter $parameter): array
    {
        $type = $parameter->getType();

        if ($type instanceof ReflectionUnionType) {
            $types = [];

            foreach ($type->getTypes() as $namedType) {
                $types[] = $this->normalizeTypeName($namedType->getName());
            }

            return array_values(array_unique($types));
        }

        if ($type instanceof ReflectionNamedType) {
            $types = [$this->normalizeTypeName($type->getName())];

            if ($type->allowsNull() && !in_array('NULL', $types, true)) {
                $types[] = 'NULL';
            }

            return $types;
        }

        return ['mixed'];
    }

    /**
     * Converts reflection type names to the legacy runtime type strings.
     *
     * @param string $typeName The reflected type name.
     * @return string
     */
    private function normalizeTypeName(string $typeName): string
    {
        return match ($typeName) {
            'bool' => 'boolean',
            'int' => 'integer',
            'float' => 'double',
            'null' => 'NULL',
            'false', 'true', 'array', 'string', 'object', 'mixed' => $typeName === 'null' ? 'NULL' : $typeName,
            default => ltrim($typeName, '\\'),
        };
    }

    /**
     * Returns the short class name for the provided fully qualified class name.
     *
     * @param string $className The fully qualified class name.
     * @return string
     */
    private function getShortClassName(string $className): string
    {
        return basename(str_replace('\\', '/', ltrim($className, '\\')));
    }

    /**
     * Resolves a docblock class name against imports and the declaring namespace.
     *
     * @param string $className The class name from PHPDoc.
     * @param ReflectionMethod $constructor The declaring constructor.
     * @return string
     */
    private function resolveDocblockClassName(string $className, ReflectionMethod $constructor): string
    {
        $className = ltrim($className, '\\');

        if (str_contains($className, '\\')) {
            return $className;
        }

        $declaringClass = $constructor->getDeclaringClass();
        $imports = $this->getImportedClasses($declaringClass->getFileName() ?: '');

        if (isset($imports[$className])) {
            return $imports[$className];
        }

        return $declaringClass->getNamespaceName() . '\\' . $className;
    }

    /**
     * Parses imported class aliases from a PHP source file.
     *
     * @param string $fileName The source file path.
     * @return array<string, string>
     */
    private function getImportedClasses(string $fileName): array
    {
        if ($fileName === '') {
            return [];
        }

        if (isset($this->importCache[$fileName])) {
            return $this->importCache[$fileName];
        }

        $contents = file_get_contents($fileName);
        if ($contents === false) {
            return $this->importCache[$fileName] = [];
        }

        preg_match_all('/^use\s+([^;]+);/m', $contents, $matches);

        $imports = [];

        foreach ($matches[1] as $importStatement) {
            $parts = preg_split('/\s+as\s+/i', trim($importStatement));
            $fullyQualifiedClassName = ltrim($parts[0], '\\');
            $alias = $parts[1] ?? $this->getShortClassName($fullyQualifiedClassName);
            $imports[$alias] = $fullyQualifiedClassName;
        }

        return $this->importCache[$fileName] = $imports;
    }

    /**
     * Normalizes a PHPDoc collection declaration to a concrete class[] shape.
     *
     * @param string $declaredType The raw PHPDoc type token.
     * @return string|null
     */
    private function normalizeCollectionDeclaration(string $declaredType): ?string
    {
        $declaredType = ltrim($declaredType, '?');

        if (preg_match('/^\((.+)\)$/', $declaredType, $matches) === 1) {
            $declaredType = $matches[1];
        }

        if (
            preg_match(
                '/^(?:array|list)<(?:[A-Za-z_\\\\][A-Za-z0-9_\\\\]*\s*,\s*)?([A-Za-z_\\\\][A-Za-z0-9_\\\\]*)>$/',
                $declaredType,
                $matches
            ) === 1
        ) {
            return $matches[1] . '[]';
        }

        if (substr($declaredType, -2) !== '[]') {
            return null;
        }

        $collectionType = substr($declaredType, 0, -2);

        if (preg_match('/^[A-Za-z_\\\\][A-Za-z0-9_\\\\]*$/', $collectionType) !== 1) {
            return null;
        }

        return $collectionType . '[]';
    }
}
