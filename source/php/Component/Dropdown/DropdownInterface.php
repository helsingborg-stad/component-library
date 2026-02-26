<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Dropdown;

use ComponentLibrary\Component\ComponentInterface;

interface DropdownInterface extends ComponentInterface
{
    /**
     * An array of arrays representing each item with a name and a link.
     */
    public function getItems(): array;

    /**
     * Where should the button link to?.
     */
    public function getHref(): string;

    /**
     * The tag to use for this component.
     */
    public function getComponentElement(): string;

    /**
     * The tag to use for each list item.
     */
    public function getItemElement(): string;

    /**
     * The direction in which the popup-menu opens in.
     */
    public function getDirection(): string;

    /**
     * Popup.
     */
    public function getPopup(): string;

}
