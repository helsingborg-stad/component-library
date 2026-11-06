<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Collection__item;

use Illuminate\View\ComponentSlot;

final class CollectionItemData
{
    public function __construct(
        public string $componentElement = 'div',
        public string|ComponentSlot $prefix = '',
        public array|bool|string|null $icon = false,
        public array|bool $iconLast = false,
        public array|bool $action = false,
        public string $secondary = '',
        public string $link = '',
        public bool $bordered = false,
    ) {}
}
