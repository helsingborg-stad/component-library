<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class OptionDataTest extends TestCase
{
    public function testTypedConfigDescribesTheOptionContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require_once __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(OptionData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('option', $config->slug);
        static::assertSame(OptionData::class, $config->data);
        static::assertSame('default', $defaults['appearance']);
        static::assertSame('', $defaults['description']);
        static::assertSame([], $defaults['stateIndicator']);
    }
}
