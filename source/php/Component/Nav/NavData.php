<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Nav;

/**
 * Typed input contract for the Nav component.
 */
final class NavData
{
    public function __construct(
        public array $items = [],
        public string $direction = 'vertical',
        public bool $includeToggle = false,
        public bool $isExtendedDropdown = false,
        public bool $allowStyle = true,
        public string $buttonStyle = 'filled',
        public string $buttonColor = 'primary',
        public string $buttonSize = '',
        public string $expandLabel = 'Expand',
        public string $height = '',
        public bool $compressed = false,
        public string $expandIcon = 'expand_more',
        public bool $indentSubLevels = false,
        public ?int $depth = null,
    ) {}
}
