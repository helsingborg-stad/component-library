<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__body;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CardBodyDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCardBodyContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('card__body', $config->slug);
        static::assertSame(CardBodyData::class, $config->data);
        static::assertSame(['slot' => ''], (new ComponentDataReflector())->getDefaultArguments(CardBodyData::class));
    }
}
