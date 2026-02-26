<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\OpenStreetMap;

use ComponentLibrary\Component\ComponentInterface;

interface OpenStreetMapInterface extends ComponentInterface
{
    /**
     * An array containing one array for each location marked on the map. Must contain latitude (lat) and longitude (lng). Can contain a tooltip and an icon.
     */
    public function getPins(): array;

    /**
     * Sets the start location of the map. Must contain latitude (lat), longitude (lng) and a zoom value between 5-20.
     */
    public function getStartPosition(): array;

    /**
     * Theming of the map (pale, dark, color, default).
     */
    public function getMapStyle(): string;

    /**
     * A css height value including unit (px, vh, %).
     */
    public function getHeight(): string;

    /**
     * True or false, sets the width of the element.
     */
    public function getFullWidth(): bool;

    /**
     * True or false, sets the default expanded value of the sidebar.
     */
    public function getExpanded(): bool;

}
