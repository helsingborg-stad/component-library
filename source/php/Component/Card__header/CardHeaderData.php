<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__header;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 * Typed input contract for the Card header area.
 */
final class CardHeaderData
{
    public function __construct(
        public string|HtmlString|ComponentSlot|null $slot = '',
    ) {}
}
