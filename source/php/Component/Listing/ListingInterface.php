<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Listing;

use ComponentLibrary\Component\ComponentInterface;

interface ListingInterface extends ComponentInterface
{
    /**
     * List of arrays containing at least 'label' but can also contain 'href' and or 'icon' according to the Icon component.
     */
    public function getList(): array;

    /**
     * The type of list, ul, ol.
     */
    public function getElementType(): string;

    /**
     * Can be true/false or the name of the Icon. Displays an icon at the end of links.
     */
    public function getIcon(): bool;

    /**
     * False or a number between 0 and 10. Sets the padding between the child elements.
     */
    public function getPadding(): bool;

}
