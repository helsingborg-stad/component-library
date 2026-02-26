<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Code;

use ComponentLibrary\Component\ComponentInterface;

interface CodeInterface extends ComponentInterface
{
    /**
     * Content.
     */
    public function getContent(): string;

    /**
     * Slot.
     */
    public function getSlot(): string;

    /**
     * Language.
     */
    public function getLanguage(): string;

    /**
     * Escape.
     */
    public function getEscape(): bool;

    /**
     * ComponentElement.
     */
    public function getComponentElement(): string;

    /**
     * PreTagElement.
     */
    public function getPreTagElement(): string;

}
