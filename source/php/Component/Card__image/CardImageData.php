<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__image;

/**
 * Typed input contract for the Card image area.
 */
final class CardImageData
{
    public function __construct(
        public string $slot = '',
    ) {}
}
