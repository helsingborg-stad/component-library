<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\NewsItem;

/**
 * Typed input contract for the NewsItem component.
 */
final class NewsItemData
{
    public function __construct(
        public ?string $heading = null,
        public ?string $subHeading = null,
        public ?string $content = null,
        public ?array $image = null,
        public ?array $date = null,
        public ?string $readTime = null,
        public bool $standing = false,
        public ?string $link = null,
        public mixed $headerRightArea = null,
        public mixed $headerLeftArea = null,
        public mixed $titleLeftArea = null,
        public mixed $titleRightArea = null,
        public mixed $contentLeftArea = null,
        public mixed $contentRightArea = null,
        public ?bool $hasPlaceholderImage = null,
    ) {}
}
