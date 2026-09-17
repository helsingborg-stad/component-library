<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Typography;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

final class TypographyData
{
    public function __construct(
        public string $element = 'p',
        public string|bool $variant = false,
        public string|HtmlString|ComponentSlot|null $slot = '',
        public bool $autopromote = false,
        public bool $useHeadingsContext = true,
    ) {}
}
