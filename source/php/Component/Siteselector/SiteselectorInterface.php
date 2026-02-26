<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Siteselector;

use ComponentLibrary\Component\ComponentInterface;

interface SiteselectorInterface extends ComponentInterface
{
    /**
     * What element the container will use.
     */
    public function getElement(): string;

    /**
     * Nav menu items.
     */
    public function getItems(): array;

    /**
     * The number of items to display before folding to a dropdown.
     */
    public function getMaxItems(): bool;

    /**
     * Te label of show more button.
     */
    public function getShowMoreLabel(): string;

    /**
     * Amount of radius (xs, sm, md, lg, full).
     */
    public function getRadius(): string;

    /**
     * Primary or secondary color.
     */
    public function getColor(): string;

}
