<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Segment;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class SegmentDataTest extends TestCase
{
    public function testTypedConfigDescribesTheSegmentContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(SegmentData::class);
        $types = $reflector->getArgumentTypes(SegmentData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('segment', $config->slug);
        static::assertSame(SegmentData::class, $config->data);
        static::assertFalse($defaults['image']);
        static::assertSame('ComponentLibrary\\Integrations\\Image\\ImageInterface|string|boolean', $types['image']);
    }
}