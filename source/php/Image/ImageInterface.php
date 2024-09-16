<?php

namespace ComponentLibrary\Image;

interface ImageInterface {

    /**
     * Get the URL of the image
     * 
     * @return string
     */
    public function getUrl(): string;

    /**
     * Get the srcset of the image.
     * If the image is to small to create a srcset, return null.
     * 
     * @return string|null
     */
    public function getSrcSet(): ?string;

    /**
     * Factory method to create an image object
     * 
     * @param int $imageId      The WordPress ID of the image
     * @param array $imageSize  Width and height of the image
     * 
     * @return ImageInterface
     */
    public function factory($imageId, $imageSize): ImageInterface;
}