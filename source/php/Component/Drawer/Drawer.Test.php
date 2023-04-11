<?php

use ComponentLibrary\Component\Drawer\Drawer;

class DrawerTest extends PHPUnit\Framework\TestCase
{
    public function testIsDefined()
    {
        $this->assertTrue(class_exists(Drawer::class));
    }

    public function testAcceptsToggleButtonArgs()
    {
        // Arrange
        $label = 'Test label';
        $data = ['toggleButtonData' => ['text' => $label]];

        // Act
        $component = new Drawer($data);
        $componentData = $component->getData();

        // Assert
        $this->assertEquals($label, $componentData['toggleButtonData']['text']);
    }

    public function testToggleButtonGetsJSToggleTriggerDataAttribute()
    {
        // Arrange
        $label = 'Test label';
        $data = ['toggleButtonData' => ['text' => $label]];

        // Act
        $component = new Drawer($data);
        $componentData = $component->getData();

        // Assert
        $this->assertArrayHasKey('js-toggle-trigger', $componentData['toggleButtonData']['attributeList']);
    }

    public function testSetsScreenSizesClass()
    {
        // Arrange
        $screenSizes = ['md', 'lg'];
        $expectedClassNames = 'u-display--none@xs u-display--none@sm';

        // Act
        $component = new Drawer(['screenSizes' => $screenSizes]);

        // Assert
        $this->assertEquals($expectedClassNames, $component->getData()['screenSizeClassNames']);
    }

    public function testDefaultScreenSizesShowsOnXsAndSmOnly()
    {
        // Arrange
        $data = [];
        $expectedClassNames = 'u-display--none@md u-display--none@lg';

        // Act
        $component = new Drawer($data);

        // Assert
        $this->assertEquals($expectedClassNames, $component->getData()['screenSizeClassNames']);
    }
}
