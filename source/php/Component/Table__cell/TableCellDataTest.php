<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table__cell;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class TableCellDataTest extends TestCase
{
    public function testTypedConfigDescribesTheTableCellContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('table__cell', $config->slug);
        static::assertSame(TableCellData::class, $config->data);
        static::assertSame(
            'integer|NULL',
            (new ComponentDataReflector())->getArgumentTypes(TableCellData::class)['index'],
        );
    }
}
