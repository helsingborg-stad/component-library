<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__footer;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CardFooterDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCardFooterContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('card__footer', $config->slug);
        static::assertSame(CardFooterData::class, $config->data);
        static::assertSame(['slot' => ''], new ComponentDataReflector()->getDefaultArguments(CardFooterData::class));
    }
}
