<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__header;

use Illuminate\Support\HtmlString;

/**
 * Typed input contract for the Card header area.
 */
final class CardHeaderData
{
    public function __construct(
        public ?HtmlString $slot = null,
    ) {}
}
