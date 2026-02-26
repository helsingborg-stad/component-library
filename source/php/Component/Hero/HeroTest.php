<?php

class HeroTest extends \PHPUnit\Framework\TestCase
{
    public function testIsDefined()
    {
        $this->assertTrue(class_exists(\ComponentLibrary\Component\Hero\Hero::class));
    }

    /**
     * @dataProvider hasNoContentProvider
     */
    public function testHasContentIsFalseIfHasNoContent($meta, $title, $byline, $paragraph)
    {
        $data = $this->getComponentData(['meta' => $meta, 'title' => $title, 'byline' => $byline, 'paragraph' => $paragraph]);
        $component = new \ComponentLibrary\Component\Hero\Hero($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $component->init();
        $data = $component->getData();

        $this->assertFalse($data['hasContent']);
    }

    public function hasNoContentProvider() {
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
        $data = $this->getComponentData(['meta' => $meta, 'title' => $title, 'byline' => $byline, 'paragraph' => $paragraph]);
        $component = new \ComponentLibrary\Component\Hero\Hero($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $component->init();
        $data = $component->getData();

        $this->assertTrue($data['hasContent']);
    }

    public function hasContentProvider() {
        return [
            ['foo', 'foo', 'foo', 'foo'],
            ['foo', '', '', ''],
            ['', 'foo', '', ''],
            ['', '', 'foo', ''],
            ['', '', '', 'foo'],
        ];
    }

    private function getComponentData(array $data)
    {
        $config = require 'source/php/Component/Hero/heroConfig.php';
        $default = (array) $config['default'];
        return array_merge($default, $data);
    }
}
