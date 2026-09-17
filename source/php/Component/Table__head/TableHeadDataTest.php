<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table__head;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class TableHeadDataTest extends TestCase
{
    public function testTypedConfigDescribesTheTableHeadContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('table__head', $config->slug);
        static::assertSame(TableHeadData::class, $config->data);
        static::assertSame([], new ComponentDataReflector()->getDefaultArguments(TableHeadData::class));
    }
}
