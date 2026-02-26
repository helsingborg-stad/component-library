<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Menu;

use ComponentLibrary\Component\ComponentInterface;

interface MenuInterface extends ComponentInterface
{
    /**
     * The currently active index.
     */
    public function getActiveIndex(): bool;

    /**
     * List of arrays containing at least 'label' and 'href' option 'icon' name as string.
     */
    public function getItems(): array;

    /**
     * The type of wrapper.
     */
    public function getElementType(): string;

    /**
     * The name of currently active class.
     */
    public function getActiveClass(): string;

    /**
     * Wrap component with <nav> etc.
     */
    public function getWrapper(): bool;

    /**
     * If the menu should render as horizontal. Default to vertical menu.
     */
    public function getIsHorizontal(): bool;

}
