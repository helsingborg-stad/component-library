<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__header;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CardHeaderDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCardHeaderContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('card__header', $config->slug);
        static::assertSame(CardHeaderData::class, $config->data);
        static::assertSame(['slot' => ''], (new ComponentDataReflector())->getDefaultArguments(CardHeaderData::class));
    }
}
