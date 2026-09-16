<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table__body;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class TableBodyDataTest extends TestCase
{
    public function testTypedConfigDescribesTheTableBodyContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('table__body', $config->slug);
        static::assertSame(TableBodyData::class, $config->data);
        static::assertSame([], (new ComponentDataReflector())->getDefaultArguments(TableBodyData::class));
    }
}
