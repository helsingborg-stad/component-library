<?php

class BlockTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider hasContentDataProvider
     */
    public function  testHasContentReturnsTrueIfHasContent($data)
    {
        $block = new ReflectionClass(\ComponentLibrary\Component\Block\Block::class);
        $hasContentMethod = $block->getMethod('hasContent');
        $hasContentMethod->setAccessible(true);

        $block = new \ComponentLibrary\Component\Block\Block($this->getComponentDefaultData(), new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $this->assertTrue($hasContentMethod->invokeArgs($block, [$data]));
    }

    /**
     * @dataProvider hasNoContentDataProvider
     */
    public function  testHasContentReturnsFalseIfHasNoContent($data)
    {
        $block = new ReflectionClass(\ComponentLibrary\Component\Block\Block::class);
        $hasContentMethod = $block->getMethod('hasContent');
        $hasContentMethod->setAccessible(true);

        $block = new \ComponentLibrary\Component\Block\Block($this->getComponentDefaultData(), new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $this->assertFalse($hasContentMethod->invokeArgs($block, [$data]));
    }

    public function hasContentDataProvider(): array
    {
        return [
            [['meta' => 'Foo']],
            [['meta' => 123]],
            [['meta' => [1, 2, 3]]],
            [['meta' => (object)[1, 2, 3]]],
        ];
    }

    public function hasNoContentDataProvider(): array
    {
        return [
            [['meta' => '']],
            [['meta' => true]],
            [['meta' => false]],
            [['meta' => []]],
            [['meta' => ['']]],
            [['meta' => new stdClass()]],
            [['meta' => (object)['']]],
        ];
    }

    private function getComponentDefaultData()
    {
        $config = require 'source/php/Component/Block/blockConfig.php';
        return (array) $config['default'];
    }
}
