<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\IconSection;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class IconSectionDataTest extends TestCase
{
    public function testTypedConfigDescribesTheIconSectionContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('iconSection', $config->slug);
        static::assertSame(IconSectionData::class, $config->data);
        static::assertSame(0, (new ComponentDataReflector())->getDefaultArguments(IconSectionData::class)['gap']);
    }
}
