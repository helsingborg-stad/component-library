<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__floating;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 * Typed input contract for the Card floating area.
 */
final class CardFloatingData
{
    public function __construct(
        public string|HtmlString|ComponentSlot|null $slot = '',
    ) {}
}
