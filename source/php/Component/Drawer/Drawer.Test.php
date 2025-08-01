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
        $component = new Drawer($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
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
        $component = new Drawer($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $componentData = $component->getData();

        // Assert
        $this->assertArrayHasKey('data-js-toggle-trigger', $componentData['toggleButtonData']['attributeList']);
    }

    public function testSetsScreenSizesClass()
    {
        // Arrange
        $screenSizes = ['md', 'lg'];
        $expectedClassNames = 'u-display--none@xs u-display--none@sm u-display--none@xl';

        // Act
        $component = new Drawer(['screenSizes' => $screenSizes], new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());

        // Assert
        $this->assertEquals($expectedClassNames, $component->getData()['screenSizeClassNames']);
    }

    public function testDefaultScreenSizesShowsOnXsAndSmOnly()
    {
        // Arrange
        $data = [];
        $expectedClassNames = 'u-display--none@md u-display--none@lg u-display--none@xl';

        // Act
        $component = new Drawer($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());

        // Assert
        $this->assertEquals($expectedClassNames, $component->getData()['screenSizeClassNames']);
    }

    public function testAttributeContainsToggleItem()
    {
        // Arrange
        $data = [];
        $component = new Drawer($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $uid = $component->getUid();
        $expectedAttribute = "data-js-toggle-item=\"drawer-$uid\"";

        // Assert
        $this->assertStringContainsString($expectedAttribute, $component->getData()['attribute']);
    }

    public function testSimulateClickPointsToToggleButtonElement()
    {
        // Arrange
        $data = [];
        $component = new Drawer($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $uid = $component->getUid();
        $simulateClickValue = "[data-js-toggle-trigger=drawer-$uid]";

        // Assert
        $this->assertStringContainsString($simulateClickValue, $component->getData()['simulateClickSelector']);
    }

    public function testMoveToAttributeIsMovedFromAttributesToVariableIfSupplied()
    {
        // Arrange
        $data = ['attributeList' => ['data-move-to' => 'foo']];
        $expectedMoveToAttribute = 'data-move-to="foo"';
        $component = new Drawer($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());

        // Assert
        $this->assertEquals($expectedMoveToAttribute, $component->getData()['moveTo']);
    }
}
