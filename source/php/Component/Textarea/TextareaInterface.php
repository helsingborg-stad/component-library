<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Textarea;

use ComponentLibrary\Component\ComponentInterface;

interface TextareaInterface extends ComponentInterface
{
    /**
     * Array of label items like labelText.
     */
    public function getLabel(): string;

    /**
     * HTML5 validation on fields.
     */
    public function getRequired(): bool;

    /**
     * Field value.
     */
    public function getValue(): string;

}
