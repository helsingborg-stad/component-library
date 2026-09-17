<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Scope;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class ScopeDataTest extends TestCase
{
    public function testTypedConfigDescribesTheScopeContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('scope', $config->slug);
        static::assertSame(ScopeData::class, $config->data);
        static::assertSame('string|array', (new ComponentDataReflector())->getArgumentTypes(ScopeData::class)['name']);
    }
}
