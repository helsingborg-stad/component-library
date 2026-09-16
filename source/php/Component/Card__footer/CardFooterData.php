<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__footer;

/**
 * Typed input contract for the Card footer area.
 */
final class CardFooterData
{
    public function __construct(
        public string $slot = '',
    ) {
    }
}
