<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Datebadge;

/**
 * Typed input contract for the Datebadge component.
 */
final class DatebadgeData
{
    public function __construct(
        public string|int|bool $date = false,
        public string $size = 'md',
        public bool $translucent = false,
        public string $color = 'light',
    ) {
    }
}
