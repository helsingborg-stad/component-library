<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Datebadge;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class DatebadgeDataTest extends TestCase
{
    public function testTypedConfigDescribesTheDatebadgeContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('datebadge', $config->slug);
        static::assertSame(DatebadgeData::class, $config->data);
        static::assertFalse(new ComponentDataReflector()->getDefaultArguments(DatebadgeData::class)['date']);
    }
}
