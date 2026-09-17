<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Paper;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

final class PaperData
{
    public function __construct(
        public string|HtmlString|ComponentSlot|null $slot = '',
        public bool|int $padding = false,
        public bool $transparent = false,
    ) {}
}
