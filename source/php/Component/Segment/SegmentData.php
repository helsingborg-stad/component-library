<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Segment;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Typed input contract for the Segment component.
 */
final class SegmentData
{
    public function __construct(
        public string $layout = 'full-width',
        public string|bool $title = false,
        public string|bool $content = false,
        public string $textSize = 'default',
        public string|ImageInterface|bool $image = false,
        public string|bool $background = false,
        public string|bool $backgroundOverlay = false,
        public string $textColor = 'dark',
        public string $height = 'content',
        public bool $paddingTop = true,
        public bool $paddingBottom = true,
        public string $textAlignment = 'top',
        public bool $reverseColumns = false,
        public string|bool $overlay = false,
        public bool $stretch = false,
        public array|bool $buttons = false,
        public string|bool $date = false,
        public string|bool $meta = false,
        public array|bool $tags = false,
        public array|bool $icon = false,
        public ?string $iconBackgroundColor = null,
        public string|bool $link = false,
        public bool $hasPlaceholder = true,
        public array|bool $lang = ['visit' => 'Visit'],
        public bool $containerAware = false,
    ) {}
}
