<?php

use PHPUnit\Framework\TestCase;
use ComponentLibrary\Integrations\Image\Image;

class ImageTest extends TestCase
{
    public function testGetUrlReturnsCorrectUrl()
    {
        $imageId = 1;
        $imageSize = [800, 600];
        $resolver = function(int $id, array $size): string {
            return (string) "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);
        $url = $image->getUrl();

        $this->assertEquals("https://example.com/image-1-800x600.jpg", $url);
    }

    public function testGetSrcSetReturnsNullIfNoImageSizes() {
        $imageId = 1;
        $imageSize = [100, 100];
        $resolver = function(int $id, array $size): string {
            return (string) "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);
        $srcSet = $image->getSrcSet();

        $this->assertNull($srcSet);
    }

    public function testgetImageSizesReturnsACorrectSizeArray() {
        $imageId = 1;
        $imageSize = [1450, 600];
        $resolver = function(int $id, array $size): string {
            return (string) "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);
        $imageSizes = $image->getImageSizes(
          $imageSize[0]
        );

        $this->assertEquals([425, 768, 1024, 1450], $imageSizes);
    }
    
    
    public function testGetSrcSetReturnsCorrectSrcSet()
    {
        $imageId = 1;
        $imageSize = [1920, 800];
        $resolver = function(int $id, array $size): string {
            return "https://example.com/image.jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);

        $srcSet = $image->getSrcSet();

        $expectedSrcSet = "https://example.com/image.jpg 425w, https://example.com/image.jpg 768w, https://example.com/image.jpg 1024w, https://example.com/image.jpg 1440w, https://example.com/image.jpg 1920w"; // Replace with expected srcSet

        $this->assertEquals($expectedSrcSet, $srcSet);
    }

    public function testGetSrcSetReturnsScaledHeight()
    {
        $imageId = 1;
        $imageSize = [1920, 800];
        $resolver = function(int $id, array $size): string {
            return "https://example.com/image-". $id ."-". implode("x", $size). ".jpg";
        };

        $image = new Image($imageId, $imageSize, $resolver);

        $srcSet = $image->getSrcSet();

        $expectedSrcSet = "https://example.com/image-1-425x177.jpg 425w, https://example.com/image-1-768x320.jpg 768w, https://example.com/image-1-1024x427.jpg 1024w, https://example.com/image-1-1440x600.jpg 1440w, https://example.com/image-1-1920x800.jpg 1920w"; // Replace with expected srcSet

        $this->assertEquals($expectedSrcSet, $srcSet);
    }

    public function testVerifyCallableSignatureThrowsExceptionOnInvalidSignature()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The callable must accept exactly 2 parameters (int $id, array $size = [{$width}, {$height}]).');

        $imageId = 1;
        $imageSize = [800, 600];

        // This resolver has an incorrect signature (only 1 parameter)
        $resolver = function(int $id): string {
            return "https://example.com/image-{$id}.jpg";
        };

        // This should throw an exception due to the incorrect signature
        new Image($imageId, $imageSize, $resolver);
    }

    public function testFactoryCreatesValidImageObject()
    {
        $imageId = 1;
        $imageSize = [800, 600];
        $resolver = function(int $id, array $size): string {
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

        $resolver = function(int $id, array $size): string {
            return "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
        };

        // This should throw an exception due to missing height in image size
        Image::factory($imageId, $imageSize, $resolver);
    }
}