<?php

use PHPUnit\Framework\TestCase;
use ComponentLibrary\Image\Image;

class ImageTest extends TestCase
{
    public function testGetUrlReturnsCorrectUrl()
    {
        $imageId = 1;
        $imageSize = [800, 600];
        $resolver = function(int $id, array $size) {
            return "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);
        $url = $image->getUrl();

        $this->assertEquals("https://example.com/image-1-800x600.jpg", $url);
    }

    public function testGetSrcSetReturnsCorrectSrcSet()
    {
        $imageId = 1;
        $imageSize = [1000, 800];
        $resolver = function(int $id, array $size) {
            return "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);
        $srcSet = $image->getSrcSet();

        $expectedSrcSet = "500w 500w, 700w 700w, 1000w 1000w"; // Replace with expected srcSet

        $this->assertEquals($expectedSrcSet, $srcSet);
    }

    public function testVerifyCallableSignatureThrowsExceptionOnInvalidSignature()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The callable must accept exactly 2 parameters (int $id, array $size = [{$width}, {$height}]).');

        $imageId = 1;
        $imageSize = [800, 600];

        // This resolver has an incorrect signature (only 1 parameter)
        $resolver = function(int $id) {
            return "https://example.com/image-{$id}.jpg";
        };

        // This should throw an exception due to the incorrect signature
        new Image($imageId, $imageSize, $resolver);
    }

    public function testFactoryCreatesValidImageObject()
    {
        $imageId = 1;
        $imageSize = [800, 600];
        $resolver = function(int $id, array $size) {
            return "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        $image = Image::factory($imageId, $imageSize, $resolver);

        $this->assertInstanceOf(Image::class, $image);
        $this->assertEquals("https://example.com/image-1-800x600.jpg", $image->getUrl());
    }

    public function testFactoryThrowsExceptionForInvalidImageSize()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Image size must be an array with width and height (keys 0,1).');

        $imageId = 1;
        $imageSize = [800]; // Missing height

        $resolver = function(int $id, array $size) {
            return "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        // This should throw an exception due to missing height in image size
        Image::factory($imageId, $imageSize, $resolver);
    }
}