<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__body;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 * Typed input contract for the Card body area.
 */
final class CardBodyData
{
    public function __construct(
        public string|HtmlString|ComponentSlot|null $slot = '',
    ) {}
}
