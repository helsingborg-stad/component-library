<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Table;

final class TableData
{
    public function __construct(
        public array $list = [],
        public array $headings = [],
        public bool $showHeader = true,
        public bool $showCaption = false,
        public bool $filterable = false,
        public bool $sortable = false,
        public bool $showSum = false,
        public bool $fullscreen = false,
        public bool $isMultidimensional = false,
        public bool $async = false,
        public string $title = '',
        public bool $includePaper = true,
        public array $labels = ['searchPlaceholder' => 'Search'],
    ) {}
}
