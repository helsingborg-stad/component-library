<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Typography;

use Illuminate\Support\HtmlString;

final class TypographyData
{
    public function __construct(
        public string $element = 'p',
        public string|bool $variant = false,
        public ?HtmlString $slot = null,
        public bool $autopromote = false,
        public bool $useHeadingsContext = true,
    ) {}
}
