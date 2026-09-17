<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tags;

final class TagsData
{
    public function __construct(
        public string $style = 'default',
        public string $componentElement = 'div',
        public string $beforeLabel = '#',
        public array $icon = [],
        public string $afterLabel = '',
        public string|bool $format = false,
        public bool $compress = false,
    ) {}
}
