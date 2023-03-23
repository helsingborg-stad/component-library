<?php

use ComponentLibrary\Component\Drawer\Drawer;

class DrawerTest extends PHPUnit\Framework\TestCase {
    public function testIsDefined() {
        $this->assertTrue(class_exists(Drawer::class));
    }

    public function testAcceptsToggleButtonArgs() {
        // Arrange
        $label = 'Test label';
        $data = ['toggleButtonData' => ['text' => $label]];

        // Act
        $component = new Drawer($data);
        $componentData = $component->getData();

        // Assert
        $this->assertEquals($label, $componentData['toggleButtonData']['text']);
    }

    public function testToggleButtonGetsJSToggleTriggerDataAttribute() {
        // Arrange
        $label = 'Test label';
        $data = ['toggleButtonData' => ['text' => $label]];

        // Act
        $component = new Drawer($data);
        $componentData = $component->getData();

        // Assert
        $this->assertArrayHasKey('js-toggle-trigger', $componentData['toggleButtonData']['attributeList']);
    }
    
    public function testSetsScreenSizesClass() {
        // Arrange
        $screenSizes = ['md', 'lg', 'xl'];
        $expectedClassNames = 'u-display--none@xs u-display--none@sm';

        // Act
        $component = new Drawer(['screenSizes' => $screenSizes]);

        // Assert
        $this->assertEquals($expectedClassNames, $component->getData()['screenSizeClassNames']);
    }
    
    public function testDefaultScreenSizesShowsOnXsAndSmOnly() {
        // Arrange
        $data = [];
        $expectedClassNames = 'u-display--none@md u-display--none@lg u-display--none@xl';
        
        // Act
        $component = new Drawer($data);

        // Assert
        $this->assertEquals($expectedClassNames, $component->getData()['screenSizeClassNames']);
    }    

    public function testScreenSizeClassesAppliedToDrawerAndButton() {
        // Arrange
        $data = ['screenSizes' => ['sm', 'md', 'lg', 'xl'], 'toggleButtonData' => ['text' => 'foo']];
        $expectedClassName = 'u-display--none@xs';

        // Assert
        $html = $this->renderComponent($data);
        $matches = preg_match_all("/$expectedClassName/", $html);

        // Act
        $this->assertEquals(2, $matches);
    }
    
    private function renderComponent(array $data) {
        $init = new ComponentLibrary\Init([__DIR__]);
        $component = new Drawer($data);
        $data = $component->getData();
        $bladeEngine = $init->getEngine();
        $bladeViewRenderer = \HelsingborgStad\RenderBladeView\BladeViewRenderer::create($bladeEngine);
        return $bladeViewRenderer->render('drawer',$data);
    }
}