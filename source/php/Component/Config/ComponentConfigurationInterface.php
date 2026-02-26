<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Config;

/**
 * Interface for component configuration objects.
 */
interface ComponentConfigurationInterface
{
    /**
     * Returns the human readable name of the component.
     */
    public function getName(): string;

    /**
     * Returns the slug used for the component.
     */
    public function getSlug(): string;

    /**
     * Returns an identifier for the component (defaults to slug).
     */
    public function getIdentifier(): string;

    /**
     * Returns the view filename for the component.
     */
    public function getView(): string;

    /**
     * Returns the default input parameters for the component.
     *
     * @return array<string, mixed>
     */
    public function getDefaultParameters(): array;

    /**
     * Returns the expected data types for input parameters.
     *
     * @return array<string, string>
     */
    public function getTypes(): array;

    /**
     * Returns the description metadata for the component.
     *
     * @return array<string, string>
     */
    public function getDescription(): array;

    /**
     * Returns dependency metadata for the component.
     *
     * @return array<string, mixed>
     */
    public function getDependencies(): array;

    /**
     * Sets the input parameters for the component.
     *
     * @param array<string, mixed> $parameters
     *
     * Implementations may choose to lock parameter updates after the first call and can surface warnings
     * (E_USER_WARNING) on subsequent calls to preserve singleton state.
     */
    public function setInputParameters(array $parameters): void;
}
