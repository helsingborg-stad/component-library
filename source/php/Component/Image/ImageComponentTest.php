<?php

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Component\Image\Image as ImageComponent;
use ComponentLibrary\Helper\TagSanitizer;
use ComponentLibrary\Integrations\Image\ImageInterface;
use ComponentLibrary\Renderer\Renderer;
use HelsingborgStad\BladeService\BladeService;
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

    public function testImageUsesOneResponsiveAttributeContract(): void
    {
        $source = $this->createMock(ImageInterface::class);
        $source->method('getUrl')->willReturn('https://example.com/image-1920x800.jpg');
        $source->method('getContainerQueryData')->willReturn([
            ['aspectRatio' => '425/177'],
            ['aspectRatio' => '1920/800'],
        ]);
        $source->method('getSrcSet')->willReturn(
            'https://example.com/image-425x177.jpg 425w, https://example.com/image-1920x800.jpg 1920w'
        );
        $source->method('getFocusPoint')->willReturn(['left' => '25', 'top' => '75']);
        $source->method('getLqipUrl')->willReturn(null);
        $source->method('getAltText')->willReturn('Alternative text');

        $data = $this->getDefaultData();
        $data['src'] = $source;

        $component = new ImageComponent(
            $data,
            $this->createMock(CacheInterface::class),
            new TagSanitizer(),
        );
        $result = $component->getData();

        $this->assertNull($result['containerQueryData']);
        $this->assertStringContainsString('loading="lazy"', $result['imgAttributes']);
        $this->assertStringContainsString('sizes="100cqw"', $result['imgAttributes']);
        $this->assertStringContainsString('width="1920"', $result['imgAttributes']);
        $this->assertStringContainsString('height="800"', $result['imgAttributes']);
        $this->assertStringContainsString('object-position: 25% 75%;', $result['imgAttributes']);
        $this->assertStringContainsString('srcset=', $result['imgAttributes']);

        $renderer = new Renderer(new BladeService([__DIR__ . '/..']));
        $markup = $renderer->render('Image.image', $result);

        $this->assertSame(1, substr_count($markup, '<img'));
    }

    public function testCallerCanPrioritizeAnImageFromAnObjectDefinition(): void
    {
        $data = $this->getDefaultData();
        $data['src'] = 'https://example.com/image.jpg';
        $data['imgAttributeList'] = (object) [
            'loading' => 'eager',
            'fetchpriority' => 'high',
            'sizes' => '100vw',
        ];

        $component = new ImageComponent(
            $data,
            $this->createMock(CacheInterface::class),
            new TagSanitizer(),
        );
        $result = $component->getData();

        $this->assertStringContainsString('loading="eager"', $result['imgAttributes']);
        $this->assertStringContainsString('fetchpriority="high"', $result['imgAttributes']);
        $this->assertStringContainsString('sizes="100vw"', $result['imgAttributes']);
        $this->assertStringNotContainsString('loading="lazy"', $result['imgAttributes']);
    }

    private function getDefaultData(): array
    {
        $definition = json_decode(file_get_contents(__DIR__ . '/image.json'), true);

        return $definition['default'];
    }
}
