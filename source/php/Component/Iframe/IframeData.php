<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Iframe;

final class IframeData
{
    public function __construct(
        public string $src = 'about:blank',
        public string $loading = 'lazy',
        public string|int $width = '100%',
        public string|int $height = '400',
        public string $frameborder = '0',
        public string|array|object|bool $labels = '',
        public string $modifier = '',
        public string $title = 'External content',
        public string|bool $poster = false,
    ) {}
}
