<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\IconSection;

/**
 * Typed input contract for the IconSection component.
 */
final class IconSectionData
{
    public function __construct(
        public int|float $gap = 0,
    ) {}
}
