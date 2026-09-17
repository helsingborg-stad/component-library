<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Slider__item;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class Slider__itemDataTest extends TestCase
{
    public function testTypedConfigDescribesTheSliderItemContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(Slider__itemData::class);
        $types = $reflector->getArgumentTypes(Slider__itemData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('slider__item', $config->slug);
        static::assertSame(Slider__itemData::class, $config->data);
        static::assertFalse($defaults['image']);
        static::assertSame('ComponentLibrary\\Integrations\\Image\\ImageInterface|string|boolean', $types['image']);
    }
}
