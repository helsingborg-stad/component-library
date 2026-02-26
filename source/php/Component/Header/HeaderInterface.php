<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Header;

use ComponentLibrary\Component\ComponentInterface;

interface HeaderInterface extends ComponentInterface
{
    /**
     * The element tag to render.
     */
    public function getComponentElement(): string;

    /**
     * Custom container id.
     */
    public function getId(): mixed;

    /**
     * Color name of the text.
     */
    public function getTextColor(): bool;

    /**
     * Color name of the background.
     */
    public function getBackgroundColor(): bool;

    /**
     * Stick to top when scrolling.
     */
    public function getSticky(): bool;

}
