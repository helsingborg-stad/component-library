<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__floating;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CardFloatingDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCardFloatingContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('card__floating', $config->slug);
        static::assertSame(CardFloatingData::class, $config->data);
        static::assertSame(
            ['slot' => ''],
            (new ComponentDataReflector())->getDefaultArguments(CardFloatingData::class),
        );
    }
}
