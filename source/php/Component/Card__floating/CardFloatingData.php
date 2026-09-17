<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__floating;

use Illuminate\Support\HtmlString;

/**
 * Typed input contract for the Card floating area.
 */
final class CardFloatingData
{
    public function __construct(
        public ?HtmlString $slot = null,
    ) {}
}
