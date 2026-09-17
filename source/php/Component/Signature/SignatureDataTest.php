<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Signature;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class SignatureDataTest extends TestCase
{
    public function testTypedConfigDescribesTheSignatureContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('signature', $config->slug);
        static::assertSame(SignatureData::class, $config->data);
        static::assertTrue(
            (new ComponentDataReflector())->getDefaultArguments(SignatureData::class)['placeholderAvatar'],
        );
    }
}
