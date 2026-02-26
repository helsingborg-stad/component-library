<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\MegaMenu;

use ComponentLibrary\Component\ComponentInterface;

interface MegaMenuInterface extends ComponentInterface
{
    /**
     * List of arrays containing at least 'label' and 'href' option 'icon' name as string.
     */
    public function getMenuItems(): array;

    /**
     * Select the type of menu parents.
     */
    public function getParentType(): string;

    /**
     * Select the style of menu parents (only applies when type equals button).
     */
    public function getParentStyle(): string|bool;

    /**
     * Select the color of the parent style. (only applies when type equals button).
     */
    public function getParentStyleColor(): string;

    /**
     * Select the type of menu children.
     */
    public function getChildType(): string;

    /**
     * Select the style of menu children. (only applies when type equals button).
     */
    public function getChildStyle(): string|bool;

    /**
     * Select the color of the child style. (only applies when type equals button).
     */
    public function getChildStyleColor(): string;

    /**
     * If true, the mega menu will be visible on mobile as well.
     */
    public function getMobile(): bool;

}
