<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Group;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class GroupDataTest extends TestCase
{
    public function testTypedConfigDescribesTheGroupContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('group', $config->slug);
        static::assertSame(GroupData::class, $config->data);
        static::assertSame('horizontal', (new ComponentDataReflector())->getDefaultArguments(GroupData::class)['direction']);
    }
}
