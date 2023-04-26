<?php

class HeroTest extends \PHPUnit\Framework\TestCase
{
    public function testIsDefined()
    {
        $this->assertTrue(class_exists(\ComponentLibrary\Component\Hero\Hero::class));
    }

    public function testHasContentIsFalseIfNoContent()
    {
        $data = $this->getComponentData([]);
        $component = new \ComponentLibrary\Component\Hero\Hero($data);
        $component->init();
        $data = $component->getData();

        $this->assertFalse($data['hasContent']);
    }

    public function testHasContentIsFalseIfContentContainsSpaces()
    {
        $data = $this->getComponentData(['meta' => ' ', 'title' => ' ', 'byline' => ' ', 'paragraph' => ' ']);
        $component = new \ComponentLibrary\Component\Hero\Hero($data);
        $component->init();
        $data = $component->getData();

        $this->assertFalse($data['hasContent']);
    }

    public function testHasContentIsTrueIfHasContent()
    {
        $data = $this->getComponentData(['title' => 'foo']);
        $component = new \ComponentLibrary\Component\Hero\Hero($data);
        $component->init();
        $data = $component->getData();

        $this->assertTrue($data['hasContent']);
    }

    private function getComponentData(array $data)
    {
        $jsonFile = file_get_contents('source/php/Component/Hero/hero.json', true);
        $json = json_decode($jsonFile, true);
        $default = $json['default'];
        return array_merge($default, $data);
    }
}
