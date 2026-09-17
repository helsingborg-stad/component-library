<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Fab;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

final class FabData
{
    public function __construct(
        public string $position = 'bottom-right',
        public string|bool $heading = false,
        public array|bool $button = false,
        public string|HtmlString|ComponentSlot|null $slot = '',
        public string|bool $closeLabel = false,
        public string|bool $closeIcon = false,
        public string $size = 'md',
    ) {}
}
