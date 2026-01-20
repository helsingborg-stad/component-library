<?php

namespace ComponentLibrary\Component\Select;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase {
    /**
     * @testdox can be instantiated
     */
    public function testCanBeInstantiated(): void {
        $select = new Select(
            static::getData(), 
            static::createCache(), 
            static::createTagSanitizer()
        );
        
        $this->assertInstanceOf(Select::class, $select);
    }

    /**
     * @testdox auto enables search when options exceed threshold
     */
    public function testAutoEnablesSearchWhenOptionsExceedThreshold(): void {
        $createOption = fn(int $i) => [ 'value' => "option_{$i}", 'label' => "Option {$i}" ];
        $options = array_map($createOption, range(0, Select::AUTO_ENABLE_SEARCH_THRESHOLD));

        $select = new Select(
            static::getData(['options' => $options]), 
            static::createCache(), 
            static::createTagSanitizer()
        );

        $this->assertTrue($select->getData()['search']);
    }

    static function getData(array $merge = []): array {
        return array_merge([
            'size' => 'md',
            'options' => [],
            'preselected' => false
        ], $merge);
    }

    private static function createCache():CacheInterface {
        return new class implements CacheInterface {
            public function get(string $key, ?string $group = null): mixed
            {
                return null;
            }
            public function set(string $key, mixed $data, ?string $group = null): void
            {
            }
        };
    }

    private static function createTagSanitizer() {
        return new class implements TagSanitizerInterface{
            public function removeATags(string $string): string
            {
                return $string;
            }
        };
    }
}
    