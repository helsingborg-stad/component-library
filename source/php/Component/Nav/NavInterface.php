<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Nav;

use ComponentLibrary\Component\ComponentInterface;

interface NavInterface extends ComponentInterface
{
    /**
     * An nested array of items containing: id, label, active, ancestor, children(bool = async loading, or array), href, style, class, and color (which overrides the color settings). Attribute list may also contain 'data-fetch-url' to enable asyncrounous fetching.
     */
    public function getItems(): array;

    /**
     * Modifier for basic direction. Accept values: 'vertical', 'horizontal.'.
     */
    public function getDirection(): string;

    /**
     * Tells wheter to include toggle button to expand childs or not. Accept values: true, false.
     */
    public function getIncludeToggle(): bool;

    /**
     * If true, the nav will be presented as an extended dropdown menu. Should only be used for top level horizontal navs.
     */
    public function getIsExtendedDropdown(): bool;

    /**
     * Allow the use of style parameter in this menu (item.style = 'button').
     */
    public function getAllowStyle(): bool;

    /**
     * If the nav is presenting buttons, what style they should be in.
     */
    public function getButtonStyle(): string;

    /**
     * If the nav is presenting buttons, what color they should be in.
     */
    public function getButtonColor(): string;

    /**
     * Prefix for labels on expand arrow. Will result in Expand: Link label, or if label is missing, just Expand.
     */
    public function getExpandLabel(): string;

    /**
     * The default height of the menu (only supports horizontal navigation). Values: sm, md, lg.
     */
    public function getHeight(): string;

    /**
     * Makes the spacing between items smaller and the overall navigation more compressed.
     */
    public function getCompressed(): bool;

    /**
     * The icon to use for the expand button. Accepts any icon name from the icon library or svg.
     */
    public function getExpandIcon(): string;

    /**
     * If true, sublevels will be indented.
     */
    public function getIndentSubLevels(): bool;

}
