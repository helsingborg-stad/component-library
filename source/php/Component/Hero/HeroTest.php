<?php

class HeroTest extends \PHPUnit\Framework\TestCase
{
    public function testIsDefined()
    {
        $this->assertTrue(class_exists(\ComponentLibrary\Component\Hero\Hero::class));
    }

    public function testLinkDerivedFromButtonPreservesTarget()
    {
        $component = new \ComponentLibrary\Component\Hero\Hero(
            $this->getComponentData([
                'buttonArgs' => ['href' => 'https://example.com', 'text' => '', 'target' => '_blank'],
            ]),
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
        $this->assertSame('_blank', $component->getData()['linkArgs']['target']);
    }

    /**
     * @dataProvider hasNoContentProvider
     */
    public function testHasContentIsFalseIfHasNoContent($meta, $title, $byline, $paragraph)
    {
        $data = $this->getComponentData([
            'meta' => $meta,
            'title' => $title,
            'byline' => $byline,
            'paragraph' => $paragraph,
        ]);
        $component = new \ComponentLibrary\Component\Hero\Hero(
            $data,
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
        $component->init();
        $data = $component->getData();

        $this->assertFalse($data['hasContent']);
    }

    public function hasNoContentProvider()
    {
        return [
            ['', '', '', ''],
            [' ', '', '', ''],
            ['', ' ', '', ''],
            ['', '', ' ', ''],
            ['', '', ' ', ' '],
        ];
    }

    /**
     * @dataProvider hasContentProvider
     */
    public function testHasContentIsTrueIfHasContent($meta, $title, $byline, $paragraph)
    {
        $data = $this->getComponentData([
            'meta' => $meta,
            'title' => $title,
            'byline' => $byline,
            'paragraph' => $paragraph,
        ]);
        $component = new \ComponentLibrary\Component\Hero\Hero(
            $data,
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
        $component->init();
        $data = $component->getData();

        $this->assertTrue($data['hasContent']);
    }

    public function hasContentProvider()
    {
        return [
            ['foo', 'foo', 'foo', 'foo'],
            ['foo', '',    '',    ''],
            ['',    'foo', '',    ''],
            ['',    '',    'foo', ''],
            ['',    '',    '',    'foo'],
        ];
    }

    public function testHeroImagesArePrioritizedByDefault()
    {
        $data = $this->getComponentData([]);

        $this->assertSame(
            [
                'loading' => 'eager',
                'fetchpriority' => 'high',
                'sizes' => '100vw',
            ],
            $data['imageAttributeList'],
        );
    }

    private function getComponentData(array $data)
    {
        $default = (new \ComponentLibrary\ComponentConfiguration\ComponentDataReflector())->getDefaultArguments(\ComponentLibrary\Component\Hero\HeroData::class);
        return array_merge($default, $data);
    }
}
