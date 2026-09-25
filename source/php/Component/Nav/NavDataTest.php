<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Nav;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class NavDataTest extends TestCase
{
    public function testTypedConfigDescribesTheNavContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(NavData::class);
        $types = $reflector->getArgumentTypes(NavData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('nav', $config->slug);
        static::assertSame(NavData::class, $config->data);
        static::assertSame([], $defaults['items']);
        static::assertSame('md', $defaults['buttonSize']);
        static::assertSame('string', $types['buttonSize']);
        static::assertSame('boolean', $types['includeToggle']);
    }
}
