<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Brand;

/**
 * Typed input contract for the Brand component.
 */
final class BrandData
{
    /**
     * @param array $logotype Attributes for the nested Logotype component.
     * @param array $text The brand name lines.
     * @param int|float|string|bool $aspectRatio The optional CSS aspect ratio.
     */
    public function __construct(
        public array $logotype = [],
        public array $text = [],
        public int|float|string|bool $aspectRatio = false,
    ) {}
}
