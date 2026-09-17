<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__footer;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 * Typed input contract for the Card footer area.
 */
final class CardFooterData
{
    public function __construct(
        public string|HtmlString|ComponentSlot|null $slot = '',
    ) {}
}
