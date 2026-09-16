<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Hero;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class HeroDataTest extends TestCase
{
    public function testTypedConfigDescribesTheHeroContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(HeroData::class);
        $types = $reflector->getArgumentTypes(HeroData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('hero', $config->slug);
        static::assertSame(HeroData::class, $config->data);
        static::assertFalse($defaults['animation']);
        static::assertSame('string|boolean', $types['animation']);
    }
}
