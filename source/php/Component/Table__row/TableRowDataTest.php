<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table__row;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class TableRowDataTest extends TestCase
{
    public function testTypedConfigDescribesTheTableRowContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('table__row', $config->slug);
        static::assertSame(TableRowData::class, $config->data);
        static::assertSame(['index' => null, 'isSummary' => false], (new ComponentDataReflector())->getDefaultArguments(TableRowData::class));
    }
}
