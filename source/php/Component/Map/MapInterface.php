<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Map;

use ComponentLibrary\Component\ComponentInterface;

interface MapInterface extends ComponentInterface
{
    /**
     * An array of objects containing lat, lng, and content.
     */
    public function getMarkers(): array;

    /**
     * An object containing lat, lng, and zoom.
     */
    public function getStartPosition(): object;

    /**
     * Theming of the map (pale, dark, color, default).
     */
    public function getMapStyle(): string;

    /**
     * A css height value including unit (px, vh, %).
     */
    public function getHeight(): string;

    /**
     * The map provider to use (openstreetmap, googlemaps).
     */
    public function getProvider(): string;

}
