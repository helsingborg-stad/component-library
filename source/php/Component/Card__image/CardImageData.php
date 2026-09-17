<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__image;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 * Typed input contract for the Card image area.
 */
final class CardImageData
{
    public function __construct(
        public string|HtmlString|ComponentSlot|null $slot = '',
    ) {}
}
