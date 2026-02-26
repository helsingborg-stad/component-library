<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Form;

use ComponentLibrary\Component\ComponentInterface;

interface FormInterface extends ComponentInterface
{
    /**
     * Set to POST by default.
     */
    public function getMethod(): string;

    /**
     * Path to file, set to # by default.
     */
    public function getAction(): string;

    /**
     * Validation method toggle on off.
     */
    public function getValidation(): bool;

    /**
     * If filled: Gives a general error message when form is invalid.
     */
    public function getErrorMessage(): string;

    /**
     * If filled: Gives a general success message when form is valid.
     */
    public function getValidateMessage(): string;

}
