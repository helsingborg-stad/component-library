<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Product;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class ProductDataTest extends TestCase
{
    public function testTypedConfigDescribesTheProductContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(ProductData::class);
        $types = $reflector->getArgumentTypes(ProductData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('product', $config->slug);
        static::assertSame(ProductData::class, $config->data);
        static::assertSame('primary', $defaults['backgroundColor']);
        static::assertSame('array', $types['prices']);
    }
}
