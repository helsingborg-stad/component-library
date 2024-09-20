<?php

namespace ComponentLibrary\Integrations\Image;

/**
 * Interface for resolving image URLs. 
 * Used to resolve image URLs in the native system.
 * 
 * @package ComponentLibrary\Integrations\Image
 */

interface ImageResolverInterface
{
    /**
     * Get the image URL by ID and size.
     *
     * @param int $id Image attachment ID.
     * @param array $size Array containing image width and height.
     * @return string|null URL of the image or null if not found.
     */
    public function getImageUrl(int $id, array $size): ?string;

    /**
     * Get the image alt text by ID.
     * 
     * @param int $id Image attachment ID.
     * 
     * @return null|string Alt text of the image or null if not found.
     */
    public function getAltText(int $id): ?string;
}