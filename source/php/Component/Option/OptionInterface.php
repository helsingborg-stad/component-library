<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

use ComponentLibrary\Component\ComponentInterface;

interface OptionInterface extends ComponentInterface
{
    /**
     * Type of option. Can be checkbox or radio.
     */
    public function getType(): string;

    /**
     * Array of label items like labelText.
     */
    public function getLabel(): string;

    /**
     * HTML5 validation on fields.
     */
    public function getRequired(): bool;

    /**
     * option value.
     */
    public function getValue(): string;

    /**
     * Set parameter to true if option should be checked on load.
     */
    public function getChecked(): bool;

}
