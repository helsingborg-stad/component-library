<?php

class ModalTest extends PHPUnit\Framework\TestCase
{

    public function testCloseButtonTextDefaultsToEmptyString()
    {
        $data = $this->getComponentData([]);
        $modal = new \ComponentLibrary\Component\Modal\Modal($data);

        // Act
        $componentData = $modal->getData();

        // Assert
        $this->assertEquals('', $componentData['closeButtonText']);
    }

    public function testCloseButtonTextIsset()
    {
        $data = $this->getComponentData(['closeButtonText' => 'Close']);
        $modal = new \ComponentLibrary\Component\Modal\Modal($data);

        // Act
        $componentData = $modal->getData();

        // Assert
        $this->assertEquals('Close', $componentData['closeButtonText']);
    }

    private function getComponentData(array $data): array
    {
        $jsonFile = file_get_contents('source/php/Component/Modal/modal.json', true);
        $json = json_decode($jsonFile, true);
        return array_merge($json['default'], $data);
    }
}
