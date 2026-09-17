<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Menu;

final class MenuData
{
    public function __construct(
        public int|bool $activeIndex = false,
        public array $items = [],
        public string $elementType = 'nav',
        public string $activeClass = '--active',
        public bool $wrapper = true,
        public bool $isHorizontal = false,
    ) {}
}
