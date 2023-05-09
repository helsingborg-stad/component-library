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
        $this->assertArrayHasKey('data-js-toggle-trigger', $componentData['toggleButtonData']['attributeList']);
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

    /**
     * @dataProvider defaultScreenSizeClassNameProvider
     */
    public function testDefaultScreenSizesAreSetIfNoneProvided(string $screenSizeClassName)
    {
        // Arrange
        $data = [];

        // Act
        $component = new Drawer($data);

        // Assert
        $this->assertStringNotContainsString($screenSizeClassName, $component->getData()['screenSizeClassNames']);
    }

    public function defaultScreenSizeClassNameProvider()
    {
        $component = new ReflectionClass(Drawer::class);
        $defaultScreenSizesProp = $component->getProperty("defaultScreenSizes");
        $defaultScreenSizesProp->setAccessible(true);
        $defaultScreenSizes = $defaultScreenSizesProp->getValue(new Drawer([]));

        return array_map(function ($screenSize) {
            return ["u-display--none@$screenSize"];
        }, $defaultScreenSizes);
    }

    public function testAttributeContainsToggleItem()
    {
        // Arrange
        $data = [];
        $component = new Drawer($data);
        $uid = $component->getUid();
        $expectedAttribute = "data-js-toggle-item=\"drawer-$uid\"";

        // Assert
        $this->assertStringContainsString($expectedAttribute, $component->getData()['attribute']);
    }

    public function testSimulateClickPointsToToggleButtonElement()
    {
        // Arrange
        $data = [];
        $component = new Drawer($data);
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
        $component = new Drawer($data);

        // Assert
        $this->assertEquals($expectedMoveToAttribute, $component->getData()['moveTo']);
    }
}
