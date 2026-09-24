<?php

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Component\Image\Image as ImageComponent;
use ComponentLibrary\Component\Image\ImageData;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use ComponentLibrary\Helper\TagSanitizer;
use ComponentLibrary\Integrations\Image\ImageInterface;
use ComponentLibrary\Renderer\BladeService\BladeServiceCreator;
use ComponentLibrary\Renderer\Renderer;
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

    public function testImageUsesContainerQuerySwitchingByDefault(): void
    {
        $source = $this->createMock(ImageInterface::class);
        $source->method('getUrl')->willReturn('https://example.com/image-1920x800.jpg');
        $source
            ->method('getContainerQueryData')
            ->willReturn([
                [
                    'uuid' => 'item-1-425',
                    'url' => 'https://example.com/image-425x177.jpg',
                    'media' => ['landscape' => '(min-width: 0px)', 'portrait' => '(min-width: 0px)'],
                    'aspectRatio' => '425/177',
                ],
                [
                    'uuid' => 'item-1-1920',
                    'url' => 'https://example.com/image-1920x800.jpg',
                    'media' => ['landscape' => '(min-width: 425px)', 'portrait' => '(min-width: 425px)'],
                    'aspectRatio' => '1920/800',
                ],
            ]);
        $source
            ->method('getSrcSet')
            ->willReturn(
                'https://example.com/image-425x177.jpg 425w, https://example.com/image-1920x800.jpg 1920w',
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

        $this->assertNotNull($result['containerQueryData']);
        $this->assertStringContainsString('c-image--container-query', implode(' ', $result['classList']));
        $this->assertStringNotContainsString('srcset=', $result['imgAttributes']);

        $renderer = new Renderer((new BladeServiceCreator())->create([__DIR__ . '/..']));
        $markup = $renderer->render('Image.image', $result);

        $this->assertSame(2, substr_count($markup, '<img'));
    }

    public function testImageUsesOneResponsiveAttributeContractWhenPreferSrcsetIsEnabled(): void
    {
        $source = $this->createMock(ImageInterface::class);
        $source->method('getUrl')->willReturn('https://example.com/image-1920x800.jpg');
        $source
            ->method('getContainerQueryData')
            ->willReturn([
                ['aspectRatio' => '425/177'],
                ['aspectRatio' => '1920/800'],
            ]);
        $source
            ->method('getSrcSet')
            ->willReturn(
                'https://example.com/image-425x177.jpg 425w, https://example.com/image-1920x800.jpg 1920w',
            );
        $source->method('getFocusPoint')->willReturn(['left' => '25', 'top' => '75']);
        $source->method('getLqipUrl')->willReturn(null);
        $source->method('getAltText')->willReturn('Alternative text');

        $data = $this->getDefaultData();
        $data['src'] = $source;
        $data['preferSrcset'] = true;

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

        $renderer = new Renderer((new BladeServiceCreator())->create([__DIR__ . '/..']));
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
        return (new ComponentDataReflector())->getDefaultArguments(ImageData::class);
    }
}
