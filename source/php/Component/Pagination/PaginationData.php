<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Pagination;

/**
 * Typed input contract for the Pagination component.
 */
final class PaginationData
{
    public function __construct(
        public array $list = [],
        public int $current = 1,
        public string $currentClass = '--is-active',
        public string $componentElement = 'nav',
        public string $listElement = 'ul',
        public string $listItem = 'li',
        public string $linkPrefix = '?pagination=',
        public string $anchorTag = '',
        public string $previousDisabled = 'false',
        public string $nextDisabled = 'false',
        public bool $useJS = false,
        public bool $randomizeOrder = false,
        public int $perPage = 10,
        public bool $maxPages = false,
        public string $buttonStyle = 'filled',
        public string $buttonSize = 'sm',
        public bool $pagesToShow = false,
        public bool $keepDOM = false,
        public bool $async = false,
    ) {
    }
}