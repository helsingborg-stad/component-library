<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\MegaMenu;

final class MegaMenuData
{
    public function __construct(
        public array $menuItems = [],
        public string $parentType = 'default',
        public string|bool $parentStyle = false,
        public string $parentStyleColor = 'primary',
        public string $childType = 'default',
        public string|bool $childStyle = false,
        public string $childStyleColor = 'primary',
        public bool $mobile = false,
    ) {}
}
