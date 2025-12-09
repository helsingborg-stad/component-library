<?php

namespace ComponentLibrary\Renderer\BladeEngine;

use PHPUnit\Framework\TestCase;
use WpService\Contracts\ApplyFilters;

class NullWpServiceTest extends TestCase
{
    /**
     * @testdox applyFilters() does nothing with the provided value
     */
    public function testApplyFiltersReturnsValueUnchanged()
    {
        $nullWpService = new NullWpService();
        $inputValue = ['some', 'test', 'values'];
        $result = $nullWpService->applyFilters('some_hook', $inputValue, 'extra_arg1', 'extra_arg2');
        static::assertSame($inputValue, $result);
    }
}
