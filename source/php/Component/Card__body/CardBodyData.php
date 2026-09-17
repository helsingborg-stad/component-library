<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__body;

use Illuminate\Support\HtmlString;

/**
 * Typed input contract for the Card body area.
 */
final class CardBodyData
{
    public function __construct(
        public ?HtmlString $slot = null,
    ) {}
}
