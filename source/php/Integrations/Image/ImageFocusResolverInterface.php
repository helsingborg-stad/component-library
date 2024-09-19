<?php

namespace ComponentLibrary\Integrations\Image;

/**
 * Interface for resolving image URLs. 
 * Used to resolve image URLs in the native system.
 * 
 * @package ComponentLibrary\Integrations\Image
 */

interface ImageFocusResolverInterface
{
    /**
     * Constructor.
     * 
     * @param string $key The key to use for the retrieval of the focus point.
     * 
     * @return void
     */
    public function __construct(string $key);

    /**
     * Get the image URL by ID and size.
     *
     * @param int $id Image attachment ID.
     * @param array $size Array containing image width and height.
     * @return array|null Focus point of the image or null if not found. Format: ['left': 'N%', 'top': 'N%']
     */
    public function getFocusPoint(int $id): array;
}