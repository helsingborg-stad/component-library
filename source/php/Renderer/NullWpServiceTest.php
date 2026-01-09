<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

use PHPUnit\Framework\TestCase;

class NullWpServiceTest extends TestCase
{
    /**
     * @testdox wpCacheGet() always returns false
     */
    public function testWpCacheGetAlwaysReturnsFalse()
    {
        $nullWpService = new NullWpService();
        $result = $nullWpService->wpCacheGet('some_key', 'some_group');
        static::assertFalse($result);
    }

    /**
     * @testdox wpCacheSet() always returns false
     */
    public function testWpCacheSetAlwaysReturnsFalse()
    {
        $nullWpService = new NullWpService();
        $result = $nullWpService->wpCacheSet('some_key', 'some_data', 'some_group');
        static::assertFalse($result);
    }

    /**
     * @testdox applyFilters() returns the provided value unchanged without applying any filters
     */
    public function testApplyFiltersReturnsValueUnchanged()
    {
        $nullWpService = new NullWpService();
        $inputValue = ['some', 'test', 'values'];
        $result = $nullWpService->applyFilters('some_hook', $inputValue, 'extra_arg1', 'extra_arg2');
        static::assertSame($inputValue, $result);
    }
}
