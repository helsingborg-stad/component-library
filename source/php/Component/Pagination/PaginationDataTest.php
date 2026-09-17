<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Pagination;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class PaginationDataTest extends TestCase
{
    public function testTypedConfigDescribesThePaginationContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(PaginationData::class);
        $types = $reflector->getArgumentTypes(PaginationData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('pagination', $config->slug);
        static::assertSame(PaginationData::class, $config->data);
        static::assertSame(10, $defaults['perPage']);
        static::assertSame('integer', $types['current']);
    }
}
