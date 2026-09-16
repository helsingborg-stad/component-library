<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\IconSection__item;

/**
 * Typed input contract for an IconSection item.
 */
final class IconSectionItemData
{
    public function __construct(
        public ?array $icon = null,
    ) {
    }
}
