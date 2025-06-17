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
     * Get the image URL by ID and size. 
     * @return array Focus point of the image or null if not found. Format: ['left': 'N%', 'top': 'N%']
     */
    public function getFocusPoint(): array;
}