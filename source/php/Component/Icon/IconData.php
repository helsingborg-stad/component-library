<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Icon;

/**
 * Typed input contract for the Icon component.
 */
final class IconData
{
    public function __construct(
        public string $size = 'inherit',
        public string $label = '',
        public string $icon = '',
        public string $color = '',
        public string $customColor = '',
        public string $componentElement = 'span',
        public ?bool $filled = null,
        public bool $isSvg = false,
        public bool $decorative = false,
    ) {
    }
}