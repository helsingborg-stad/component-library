<?php

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase {
    
    /**
     * @testdox Test that the class is added to the classList if image is truthy
     */
    public function testImageClassIsAdded() {
        $controller = $this->getController(['image' => true]);
        $controller->init();
        

        $this->assertContains('c-card--has-image', $controller->getData()['classList']);
    }

    /**
     * @testdox Test that the class is added to the classList if hasPlaceholder and date is truthy
     */
    public function testImageClassIsAddedWithPlaceholder() {
        $controller = $this->getController(['hasPlaceholder' => true]);
        $controller->init();

        $this->assertContains('c-card--has-image', $controller->getData()['classList']);
    }

    /**
     * @testdox $contentHtmlElement is "div" if content contains html
     * @dataProvider contentWithHtmlProvider
     */
    public function testContentHtmlElementIsDiv($content) {
        $controller = $this->getController(['content' => $content]);
        $controller->init();

        $this->assertEquals('div', $controller->getData()['contentHtmlElement']);
    }

    /**
     * @testdox $contentHtmlElement is "p" if content does not contain html
     * @dataProvider contentWithoutHtmlProvider
     */
    public function testContentHtmlElementIsP($content) {
        $controller = $this->getController(['content' => $content]);
        $controller->init();

        $this->assertEquals('p', $controller->getData()['contentHtmlElement']);
    }

    private function contentWithHtmlProvider(): array
    {
        return [
            ['<p>Test</p>'],
            ['<div>Test</div>'],
            ['<span>Test</span>'],
            ['<ul><li>Test</li></ul>'],
            ['<p class="test">Test with classname</p>'],
        ];
    }

    private function contentWithoutHtmlProvider(): array
    {
        return [
            ['Test'],
            ['Another test'],
            ['12345'],
            ['!@#$%']
        ];
    }

    private function getController(array $data = []): Card
    {
        $default = [
            'buttons' => false,
            'classList' => [],
            'collapsible' => false,
            'content' => false,
            'dateBadge' => false,
            'hasPlaceholder' => false,
            'image' => false,
            'link' => false,
            'ratio' => false,
            'tags' => false,
            'date' => null
        ];

        return new Card(array_merge($default, $data), $this->createMock(CacheInterface::class), new \ComponentLibrary\Helper\TagSanitizer());
    }
}