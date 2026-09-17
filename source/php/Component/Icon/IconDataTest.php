<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Icon;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class IconDataTest extends TestCase
{
    public function testTypedConfigDescribesTheIconContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(IconData::class);
        $types = $reflector->getArgumentTypes(IconData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('icon', $config->slug);
        static::assertSame(IconData::class, $config->data);
        static::assertNull($defaults['filled']);
        static::assertSame('boolean|NULL', $types['filled']);
    }
}
