<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Select;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class SelectDataTest extends TestCase
{
    public function testTypedConfigDescribesTheSelectContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(SelectData::class);
        $types = $reflector->getArgumentTypes(SelectData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('select', $config->slug);
        static::assertSame(SelectData::class, $config->data);
        static::assertNull($defaults['search']);
        static::assertSame('boolean|NULL', $types['search']);
    }
}
