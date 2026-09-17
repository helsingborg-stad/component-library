<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Paper;

use Illuminate\Support\HtmlString;

final class PaperData
{
    public function __construct(
        public ?HtmlString $slot = null,
        public bool $padding = false,
        public bool $transparent = false,
    ) {}
}
