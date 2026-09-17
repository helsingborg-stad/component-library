<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Loader;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class LoaderDataTest extends TestCase
{
    public function testTypedConfigDescribesTheLoaderContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('loader', $config->slug);
        static::assertSame(LoaderData::class, $config->data);
        static::assertSame('circular', new ComponentDataReflector()->getDefaultArguments(LoaderData::class)['shape']);
    }
}
