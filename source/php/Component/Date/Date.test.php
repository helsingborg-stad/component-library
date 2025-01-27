<?php

namespace ComponentLibrary\Component\Date;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class Date
 * Handles various date-related actions like formatting, calculating time since/until, and tooltip generation.
 */
class DateTest extends TestCase {

    /**
     * @testdox class can be instantiated
     */
    public function testCanBeCreated() {
        $instance = new Date($this->getDefaultData(), $this->getCacheMock());
        $this->assertInstanceOf(Date::class, $instance);
    }

    /**
     * @testdox can be instantiated with a valid timestamp
     */
    public function testCanBeCreatedWithValidTimestamp() {
        $data = $this->getDefaultData();
        $data['timestamp'] = '2021-01-01';

        try {
            new Date($data, $this->getCacheMock());
        } catch (\InvalidArgumentException $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }
    }

    /**
     * @testdox can be instantiated with unix timestamp
     */
    public function testCanBeCreatedWithUnixTimestamp() {
        $data = $this->getDefaultData();
        $data['timestamp'] = strtotime('2021-01-01');
        
        $instance = new Date($data, $this->getCacheMock());
        
        $this->assertEquals('2021-01-01', $instance->getData()['refinedDate']);
    }

    /**
     * @testdox handles timesince action
     */
    public function testHandlesTimesinceAction() {
        $data = $this->getDefaultData();
        $data['action'] = 'timesince';
        $data['timestamp'] = time();
        
        $instance = new Date($data, $this->getCacheMock());
        
        $this->assertStringContainsString('Just now', $instance->getData()['refinedDate']);
    }

    /**
     * @testdox calculates time since correctly
     */
    public function testCalculatesTimeSinceCorrectly() {
        $data = $this->getDefaultData();
        $data['action'] = 'timesince';
        $data['timestamp'] = strtotime('-1 hour');
        
        $instance = new Date($data, $this->getCacheMock());
        
        $this->assertStringContainsString('1 hour', $instance->getData()['refinedDate']);
    }

    /**
     * @testdox allows custom format
     * @dataProvider formatProvider
     */
    public function testAllowsCustomFormat($timestamp, $format, $result) {
        $data = $this->getDefaultData();
        $data['timestamp'] = $timestamp;
        $data['format'] = $format;
        
        $instance = new Date($data, $this->getCacheMock());
        
        $this->assertEquals($result, $instance->getData()['refinedDate']);
    }

    private function formatProvider():array{
        return [
            'F j, Y' => [
                'timestamp' => strtotime('2021-01-01'),
                'format' => 'F j, Y',
                'result' => 'January 1, 2021'
            ],
            'Y-m-d' => [
                'timestamp' => strtotime('2021-01-01'),
                'format' => 'Y-m-d',
                'result' => '2021-01-01'
            ],
            'Y-m-d H:i:s' => [
                'timestamp' => strtotime('2021-01-01 12:00:00'),
                'format' => 'Y-m-d H:i:s',
                'result' => '2021-01-01 12:00:00'
            ]
        ];
    }

    private function getDefaultData():array {
        return [
            'format' => 'Y-m-d',
            'region' => 'SE',
            'timezone' => 'Europe/Stockholm',
            'timestamp' => time(),
            'action' => 'formatDate'
        ];
    }

    private function getCacheMock():CacheInterface|MockObject {
        return $this->getMockBuilder(CacheInterface::class)->getMock();
    }
}