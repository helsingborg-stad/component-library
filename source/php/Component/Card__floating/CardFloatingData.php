<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__floating;

/**
 * Typed input contract for the Card floating area.
 */
final class CardFloatingData
{
    public function __construct(
        public string $slot = '',
    ) {
    }
}
