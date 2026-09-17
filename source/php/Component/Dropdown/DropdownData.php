<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Dropdown;

final class DropdownData
{
    public function __construct(
        public array $items = [],
        public string $href = '#',
        public string $componentElement = 'div',
        public string $itemElement = 'a',
        public string $direction = 'bottom',
        public string $popup = '',
    ) {}
}
