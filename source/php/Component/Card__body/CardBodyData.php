<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__body;

/**
 * Typed input contract for the Card body area.
 */
final class CardBodyData
{
    public function __construct(
        public string $slot = '',
    ) {}
}
