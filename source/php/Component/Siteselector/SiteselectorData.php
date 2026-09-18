<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Siteselector;

final class SiteselectorData
{
    public function __construct(
        public string $element = 'div',
        public array $items = [],
        public int|bool $maxItems = false,
        public string $showMoreLabel = '',
    ) {}
}
