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
        $docComment = $constructor->getDocComment();

        if (!is_string($docComment) || $docComment === '') {
            return [];
        }

        preg_match_all('/@param\s+([^\s]+)\s+\$([^\s]+)/', $docComment, $matches, PREG_SET_ORDER);

        $collectionTypes = [];

        foreach ($matches as $match) {
            $declaredType = $this->normalizeCollectionDeclaration($match[1]);
            $parameterName = $match[2];

            if ($declaredType === null || substr($declaredType, -2) !== '[]') {
                continue;
            }

            $collectionTypes[$parameterName] = $this->getShortClassName(substr($declaredType, 0, -2));
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
