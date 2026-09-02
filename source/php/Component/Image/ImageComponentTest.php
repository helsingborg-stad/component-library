<?php

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Component\Image\Image as ImageComponent;
use ComponentLibrary\Helper\TagSanitizer;
use ComponentLibrary\Integrations\Image\ImageInterface;
use PHPUnit\Framework\TestCase;

class ImageComponentTest extends TestCase
{
    public function testImageValuesAreReadOnceDuringInitialization(): void
    {
        $source = $this->createMock(ImageInterface::class);
        $source->expects($this->once())->method('getUrl')->willReturn('https://example.com/image.jpg');
        $source->expects($this->once())->method('getContainerQueryData')->willReturn([]);
        $source->expects($this->once())->method('getSrcSet')->willReturn(null);
        $source->expects($this->once())->method('getFocusPoint')->willReturn(['left' => '50', 'top' => '50']);
        $source->expects($this->once())->method('getLqipUrl')->willReturn('https://example.com/lqip.jpg');
        $source->expects($this->never())->method('getAltText');

        $data = $this->getDefaultData();
        $data['src'] = $source;
        $data['alt'] = 'Alternative text';

        new ImageComponent(
            $data,
            $this->createMock(CacheInterface::class),
            new TagSanitizer(),
        );
    }

    private function getDefaultData(): array
    {
        $definition = json_decode(file_get_contents(__DIR__ . '/image.json'), true);

        return $definition['default'];
    }
}
