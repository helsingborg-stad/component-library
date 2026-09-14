<?php

declare(strict_types=1);

namespace ComponentLibrary\ComponentConfiguration;

/**
 * Describes a component without mixing metadata into its input contract.
 */
class ComponentConfig
{
    /**
     * @param string $slug The public component slug.
     * @param string $view The Blade view file for the component.
     * @param string|null $data The typed data object class name.
     * @param array $dependencies Component metadata such as Sass dependencies.
     */
    public function __construct(
        public string $slug,
        public string $view,
        public ?string $data = null,
        public array $dependencies = [],
    ) {
    }
}
