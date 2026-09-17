<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__footer;

use Illuminate\Support\HtmlString;

/**
 * Typed input contract for the Card footer area.
 */
final class CardFooterData
{
    public function __construct(
        public ?HtmlString $slot = null,
    ) {}
}
