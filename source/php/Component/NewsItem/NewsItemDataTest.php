<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\NewsItem;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class NewsItemDataTest extends TestCase
{
    public function testTypedConfigDescribesTheNewsItemContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(NewsItemData::class);
        $types = $reflector->getArgumentTypes(NewsItemData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('newsItem', $config->slug);
        static::assertSame(NewsItemData::class, $config->data);
        static::assertNull($defaults['heading']);
        static::assertSame('string|NULL', $types['heading']);
    }
}