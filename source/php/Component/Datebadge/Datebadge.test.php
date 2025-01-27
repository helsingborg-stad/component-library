<?php

namespace ComponentLibrary\Component\Datebadge;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DatebadgeTest extends TestCase {
    /**
     * @testdox class can be instantiated
     */
    public function testCanBeCreated() {
        $instance = new Datebadge($this->getDefaultData(), $this->getCacheMock());
        $this->assertInstanceOf(Datebadge::class, $instance);
    }

    /**
     * @testdox sets month day and time from date
     */
    public function testSetsMonthDayAndTimeFromDate() {
        $data = $this->getDefaultData();
        $data['date'] = '2021-01-01 14:00';
        
        $instance = new Datebadge($data, $this->getCacheMock());
        
        $this->assertEquals('Jan', $instance->getData()['month']);
        $this->assertEquals('1', $instance->getData()['day']);
        $this->assertEquals('14:00', $instance->getData()['time']);
    }

    /**
     * @testdox accepts unix timestamp as date
     */
    public function testAcceptsUnixTimestampAsDate() {
        $data = $this->getDefaultData();
        $data['date'] = strtotime('2021-01-01 14:00');
        
        $instance = new Datebadge($data, $this->getCacheMock());
        
        $this->assertEquals('Jan', $instance->getData()['month']);
        $this->assertEquals('1', $instance->getData()['day']);
        $this->assertEquals('14:00', $instance->getData()['time']);
    }

    private function getDefaultData():array {
        return [
            'date' => '2021-01-01',
            'size' => 'sm',
        ];
    }

    private function getCacheMock():CacheInterface|MockObject {
        return $this->createMock(\ComponentLibrary\Cache\CacheInterface::class);
    }
}