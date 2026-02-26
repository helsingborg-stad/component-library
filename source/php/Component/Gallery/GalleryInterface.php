<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Gallery;

use ComponentLibrary\Component\ComponentInterface;

interface GalleryInterface extends ComponentInterface
{
    /**
     * Array with following keys: largeImage, smallImage, caption and alt.
     */
    public function getList(): array;

    /**
     * Object with following keys: prev, next.
     */
    public function getAriaLabels(): object;

}
