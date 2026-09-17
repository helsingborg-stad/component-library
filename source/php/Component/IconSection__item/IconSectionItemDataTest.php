<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\IconSection__item;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class IconSectionItemDataTest extends TestCase
{
    public function testTypedConfigDescribesTheIconSectionItemContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('iconSection__item', $config->slug);
        static::assertSame(IconSectionItemData::class, $config->data);
        static::assertSame(
            ['icon' => null],
            new ComponentDataReflector()->getDefaultArguments(IconSectionItemData::class),
        );
    }
}
