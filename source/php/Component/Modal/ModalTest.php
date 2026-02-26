<?php

class ModalTest extends PHPUnit\Framework\TestCase
{

    public function testCloseButtonTextDefaultsToEmptyString()
    {
        $data = $this->getComponentData([]);
        $modal = new \ComponentLibrary\Component\Modal\Modal($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());

        // Act
        $componentData = $modal->getData();

        // Assert
        $this->assertEquals('', $componentData['closeButtonText']);
    }

    public function testCloseButtonTextIsset()
    {
        $data = $this->getComponentData(['closeButtonText' => 'Close']);
        $modal = new \ComponentLibrary\Component\Modal\Modal($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());

        // Act
        $componentData = $modal->getData();

        // Assert
        $this->assertEquals('Close', $componentData['closeButtonText']);
    }

    private function getComponentData(array $data): array
    {
        $config = require 'source/php/Component/Modal/modalConfig.php';
        return array_merge((array) $config['default'], $data);
    }
}
