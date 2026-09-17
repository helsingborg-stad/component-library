<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Hero;

final class HeroData
{
    public function __construct(
        public mixed $image = false,
        public array $imageAttributeList = ['loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => '100vw'],
        public array $imageFocus = ['top' => 30, 'left' => 50],
        public mixed $video = false,
        public string $size = 'normal',
        public string $title = '',
        public string $byline = '',
        public string $paragraph = '',
        public bool $stretch = false,
        public string|bool $animation = false,
        public string $ariaLabel = 'Hero',
        public string $heroView = 'default',
        public mixed $customHeroData = false,
        public mixed $meta = false,
        public mixed $background = false,
        public string $textColor = '',
        public string $textAlignment = 'left',
        public string $contentBackgroundColor = '',
        public string $contentAlignmentVertical = 'bottom',
        public string $contentAlignmentHorizontal = 'left',
        public bool $contentApplyRoundedCorners = true,
        public bool $contentApplyShadows = true,
        public array $buttonArgs = [],
        public mixed $poster = false,
        public string $overlay = '',
        public mixed $content = false,
    ) {}
}
