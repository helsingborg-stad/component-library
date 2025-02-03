<?php

use PHPUnit\Framework\TestCase;
use ComponentLibrary\Integrations\Image\Image;
use ComponentLibrary\Integrations\Image\ImageResolverInterface;
use ComponentLibrary\Integrations\Image\ImageFocusResolverInterface;

class ImageTest extends TestCase
{
    public function testGetUrlReturnsCorrectUrl()
    {
        $imageId = 1;
        $imageSize = [800, 600];

        $image = new Image($imageId, $imageSize, $this->getResolver());
        $url = $image->getUrl();

        $this->assertEquals("https://example.com/image-1-800x600.jpg", $url);
    }

    public function testGetSrcSetReturnsNullIfNoImageSizes() {
        $imageId = 1;
        $imageSize = [100, 100];
        $image = new Image($imageId, $imageSize, $this->getResolver());
        $srcSet = $image->getSrcSet();

        $this->assertNull($srcSet);
    }

    public function testgetImageSizesReturnsACorrectSizeArray() {
        $imageId = 1;
        $imageSize = [1450, 600];
        $image = new Image($imageId, $imageSize, $this->getResolver());
        $imageSizes = $image->getImageSizes(
          $imageSize[0]
        );

        $this->assertEquals([425, 768, 1024, 1450], $imageSizes);
    }
    
    public function testGetSrcSetReturnsCorrectSrcSet()
    {
        $imageId = 1;
        $imageSize = [1920, 800];

        $image = new Image($imageId, $imageSize, $this->getResolver());

        $srcSet = $image->getSrcSet();

        $expectedSrcSet = "https://example.com/image-1-425x177.jpg 425w, https://example.com/image-1-768x320.jpg 768w, https://example.com/image-1-1024x427.jpg 1024w, https://example.com/image-1-1440x600.jpg 1440w, https://example.com/image-1-1680x700.jpg 1680w, https://example.com/image-1-1920x800.jpg 1920w";

        $this->assertEquals($expectedSrcSet, $srcSet);
    }

    public function testGetSrcSetReturnsScaledHeight()
    {
        $imageId = 1;
        $imageSize = [1920, 800];

        $image = new Image($imageId, $imageSize, $this->getResolver());

        $srcSet = $image->getSrcSet();

        $expectedSrcSet = "https://example.com/image-1-425x177.jpg 425w, https://example.com/image-1-768x320.jpg 768w, https://example.com/image-1-1024x427.jpg 1024w, https://example.com/image-1-1440x600.jpg 1440w, https://example.com/image-1-1680x700.jpg 1680w, https://example.com/image-1-1920x800.jpg 1920w"; // Replace with expected srcSet

        $this->assertEquals($expectedSrcSet, $srcSet);
    }

    public function testFactoryCreatesValidImageObject()
    {
        $imageId = 1;
        $imageSize = [800, 600];

        $image = Image::factory($imageId, $imageSize, $this->getResolver());

        $this->assertInstanceOf(Image::class, $image);
        $this->assertEquals("https://example.com/image-1-800x600.jpg", $image->getUrl());
    }

    public function testFactoryThrowsExceptionForInvalidImageSize()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Image size must be an array with width and height (keys 0,1).');
        Image::factory(1, [800], $this->getResolver());
    }

    public function testGetFocusPointReturnsCorrectFocusPoint()
    {
        $imageId = 1;
        $imageSize = [800, 600];

        $image = new Image($imageId, $imageSize, $this->getResolver(), $this->getFocusResolver());
        $focusPoint = $image->getFocusPoint();

        $this->assertEquals(['left' => '51', 'top' => '51'], $focusPoint);
    }

    public function testGetFocusPointReturnsCorrectFocusPointForDefault()
    {
        $imageId = 1;
        $imageSize = [800, 600];

        $image = new Image($imageId, $imageSize, $this->getResolver());
        $focusPoint = $image->getFocusPoint();

        $this->assertEquals($image::DEFAULT_FOCUS_POINT, $focusPoint);
    }

    /**
     * Get a reusable resolver for testing
     * 
     * @return ImageResolverInterface
     */
    private function getResolver(): ImageResolverInterface {
        return new class implements ImageResolverInterface {
            public function getImageUrl(int $id, array $size): string {
                return "https://example.com/image-{$id}-{$size[0]}x{$size[1]}.jpg";
            }
            public function getImageAltText(int $id): string {
                return "Image {$id}";
            }
        };
    }

    /**
     * Get a reusable focus resolver for testing
     * 
     * @return ImageFocusResolverInterface
     */
    private function getFocusResolver(): ImageFocusResolverInterface {
        return new class implements ImageFocusResolverInterface {
            public function __construct(private $data = null) {}
            public function getFocusPoint(): array {
                return ['left' => '51', 'top' => '51'];
            }
        };
    }
    
}