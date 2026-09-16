<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\ProgressBar;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use PHPUnit\Framework\TestCase;

class ProgressBarDataTest extends TestCase
{
    public function testTypedConfigDescribesTheProgressBarContract(): void
    {
        $config = require __DIR__ . '/config.php';

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('progressBar', $config->slug);
        static::assertSame(ProgressBarData::class, $config->data);
        static::assertSame(['isCancelled' => false, 'value' => 0], (new ComponentDataReflector())->getDefaultArguments(ProgressBarData::class));
    }
}
