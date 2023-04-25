<?php

class HeroTest extends \PHPUnit\Framework\TestCase
{
    public function testIsDefined()
    {
        $this->assertTrue(class_exists(\ComponentLibrary\Component\Hero\Hero::class));
    }

    public function testHasContentIsFalseIfNoContent() {
        $component = new \ComponentLibrary\Component\Hero\Hero(array(
            'textAlignment' => '',
        ));
        $component->init();
        $data = $component->getData();

        $this->assertFalse($data['hasContent']);
    }

    public function testHasContentIsFalseIfContentContainsSpaces()
    {
        $component = new \ComponentLibrary\Component\Hero\Hero(array(
            'textAlignment' => '',
            'meta' => ' ',
            'title' => ' ',
            'byline' => ' ',
            'paragraph' => ' ',
        ));
        $component->init();
        $data = $component->getData();

        $this->assertFalse($data['hasContent']);
    }
    
    public function testHasContentIsTrueIfHasContent()
    {
        $component = new \ComponentLibrary\Component\Hero\Hero(array(
            'textAlignment' => '',
            'title' => 'foo'
        ));
        $component->init();
        $data = $component->getData();

        $this->assertTrue($data['hasContent']);
    }
}