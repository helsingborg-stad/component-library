<?php

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase {
    
    /**
     * @testdox Test that the class is added to the classList if image is truthy
     */
    public function testFoo() {
        $controller = $this->getController(['image' => true]);
        $controller->init();
        

        $this->assertContains('c-card--has-image', $controller->getData()['classList']);
    }

    /**
     * @testdox Test that the class is added to the classList if hasPlaceholder and date is truthy
     */
    public function testBar() {
        $controller = $this->getController(['hasPlaceholder' => true]);
        $controller->init();

        $this->assertContains('c-card--has-image', $controller->getData()['classList']);
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

        return new Card(array_merge($default, $data), $this->createMock(CacheInterface::class));
    }
}