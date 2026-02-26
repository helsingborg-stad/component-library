<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Config;

use InvalidArgumentException;

/**
 * Component configuration implemented as a singleton per slug.
 */
class ComponentConfiguration implements ComponentConfigurationInterface
{
    /**
     * @var array<string, self>
     */
    private static array $instances = [];

    private string $slug;

    private string $name;

    private string $identifier;

    private string $view;

    /**
     * @var array<string, mixed>
     */
    private array $defaultParameters = [];

    /**
     * @var array<string, string>
     */
    private array $types = [];

    /**
     * @var array<string, string>
     */
    private array $description = [];

    /**
     * @var array<string, mixed>
     */
    private array $dependencies = [];

    private bool $inputParametersLocked = false;

    /**
     * @param array<string, mixed> $config
     */
    private function __construct(array $config)
    {
        $this->slug = $config['slug'] ?? '';

        if ($this->slug === '') {
            throw new InvalidArgumentException('Component configuration must define a slug.');
        }

        $this->name = $config['name'] ?? $this->slug;
        $this->identifier = $config['identifier'] ?? $this->slug;
        $this->view = $config['view'] ?? ($this->slug . '.blade.php');
        $this->types = (array) ($config['types'] ?? []);
        $this->description = (array) ($config['description'] ?? []);
        // Prefer 'dependencies'; keep 'dependency' for backward compatibility.
        $this->dependencies = (array) ($config['dependencies'] ?? $config['dependency'] ?? []);

        $this->initializeInputParameters((array) ($config['default'] ?? []));
    }

    /**
     * @param array<string, mixed> $config
     */
    public static function getInstance(array $config): self
    {
        $slug = $config['slug'] ?? '';

        if ($slug === '') {
            throw new InvalidArgumentException('Component configuration must define a slug.');
        }

        if (!isset(self::$instances[$slug])) {
            self::$instances[$slug] = new self($config);
        }

        return self::$instances[$slug];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getDefaultParameters(): array
    {
        return $this->defaultParameters;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getDescription(): array
    {
        return $this->description;
    }

    /**
     * Returns dependency metadata for the component.
     * Uses the "dependencies" config key; "dependency" is supported for backward compatibility.
     *
     * @deprecated Use the "dependencies" config key; support for "dependency" will be removed in a future release.
     *
     * @return array<string, mixed>
     */
    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    private function initializeInputParameters(array $parameters): void
    {
        $this->defaultParameters = $parameters;
    }

    public function setInputParameters(array $parameters): void
    {
        if ($this->inputParametersLocked) {
            throw new InvalidArgumentException(
                sprintf('Input parameters for component "%s" are already locked and cannot be changed.', $this->slug)
            );
        }

        $this->defaultParameters = $parameters;
        $this->inputParametersLocked = true;
    }
}
