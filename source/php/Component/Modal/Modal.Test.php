<?php

class ModalTest extends PHPUnit\Framework\TestCase
{

    public function testCloseButtonTextDefaultsToEmptyString()
    {
        $data = [];
        $modal = new \ComponentLibrary\Component\Modal\Modal($data);

        // Act
        $componentData = $modal->getData();

        // Assert
        $this->assertEquals('', $componentData['closeButtonText']);
    }

    public function testCloseButtonTextIsset()
    {
        $data = ['closeButtonText' => 'Close'];
        $modal = new \ComponentLibrary\Component\Modal\Modal($data);

        // Act
        $componentData = $modal->getData();

        // Assert
        $this->assertEquals('Close', $componentData['closeButtonText']);
    }
}
