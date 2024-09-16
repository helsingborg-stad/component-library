<?php

namespace ComponentLibrary\Image;

interface ImageInterface {
    public function getUrl(): string;
    public function getSrcSet(): string;
    public function factory($imageId, $imageSize): ImageInterface;
}