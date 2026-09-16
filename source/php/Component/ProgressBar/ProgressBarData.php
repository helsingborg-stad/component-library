<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\ProgressBar;

/**
 * Typed input contract for the ProgressBar component.
 */
final class ProgressBarData
{
    public function __construct(
        public bool $isCancelled = false,
        public int|float $value = 0,
    ) {
    }
}
