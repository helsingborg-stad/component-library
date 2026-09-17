<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Code;

use Illuminate\Support\HtmlString;

final class CodeData
{
    public function __construct(
        public string $content = 'Undocumented code...',
        public ?HtmlString $slot = null,
        public string $language = 'php',
        public bool $escape = false,
        public string $componentElement = 'div',
        public string $preTagElement = 'pre',
    ) {}
}
