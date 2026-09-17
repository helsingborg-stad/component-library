<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Code;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

final class CodeData
{
    public function __construct(
        public string $content = 'Undocumented code...',
        public string|HtmlString|ComponentSlot|null $slot = '',
        public string $language = 'php',
        public bool $escape = false,
        public string $componentElement = 'div',
        public string $preTagElement = 'pre',
    ) {}
}
