<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Element;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class ElementDataTest extends TestCase
{
    public function testTypedConfigDescribesTheElementContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('element', $config->slug);
        static::assertSame(ElementData::class, $config->data);
        static::assertSame(['componentElement' => 'div', 'hideIfNoContent' => true], (new ComponentDataReflector())->getDefaultArguments(ElementData::class));
    }
}
