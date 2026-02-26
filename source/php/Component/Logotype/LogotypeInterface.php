<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Logotype;

use ComponentLibrary\Component\ComponentInterface;

interface LogotypeInterface extends ComponentInterface
{
    /**
     * A image source.
     */
    public function getSrc(): bool;

    /**
     * Alt text for the image.
     */
    public function getAlt(): string;

    /**
     * A label below the logotype. eg company name.
     */
    public function getCaption(): string;

    /**
     * A title (not displayed).
     */
    public function getTitle(): string;

    /**
     * What to show if an invalid url is entered.
     */
    public function getPlaceholderText(): string;

    /**
     * Enable / disable ripple fx.
     */
    public function getHasRipple(): bool;

}
