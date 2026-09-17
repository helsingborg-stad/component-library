<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__image;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CardImageDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCardImageContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('card__image', $config->slug);
        static::assertSame(CardImageData::class, $config->data);
        static::assertSame(['slot' => ''], (new ComponentDataReflector())->getDefaultArguments(CardImageData::class));
    }
}
