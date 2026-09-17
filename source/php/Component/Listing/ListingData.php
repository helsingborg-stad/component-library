<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Listing;

final class ListingData
{
    public function __construct(
        public array $list = [],
        public string $elementType = 'ul',
        public bool $icon = true,
        public bool $padding = false,
    ) {}
}
