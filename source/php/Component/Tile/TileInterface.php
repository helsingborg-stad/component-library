<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tile;

use ComponentLibrary\Component\ComponentInterface;

interface TileInterface extends ComponentInterface
{
    /**
     * Array with following keys: largeImage, smallImage, caption and alt.
     */
    public function getWidth(): string;

    /**
     * Array with following keys: largeImage, smallImage, caption and alt.
     */
    public function getHeight(): string;

    /**
     * BackgroundImage.
     */
    public function getBackgroundImage(): string;

}
