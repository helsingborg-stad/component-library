<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\InlineCssWrapper;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class InlineCssWrapperDataTest extends TestCase
{
    public function testTypedConfigDescribesTheInlineCssWrapperContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('inlineCssWrapper', $config->slug);
        static::assertSame(InlineCssWrapperData::class, $config->data);
        static::assertSame(
            ['componentElement' => 'div', 'styles' => []],
            new ComponentDataReflector()->getDefaultArguments(InlineCssWrapperData::class),
        );
    }
}
