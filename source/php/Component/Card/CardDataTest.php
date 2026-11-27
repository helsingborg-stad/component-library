<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class CardDataTest extends TestCase
{
    public function testTypedConfigDescribesTheCardContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(CardData::class);
        $types = $reflector->getArgumentTypes(CardData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('card', $config->slug);
        static::assertSame(CardData::class, $config->data);
        static::assertFalse($defaults['image']);
        static::assertSame('ComponentLibrary\\Integrations\\Image\\ImageInterface|boolean|array', $types['image']);
    }
}
