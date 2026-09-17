<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\Integrations\Image\ImageInterface;
use Illuminate\Support\HtmlString;

/**
 * Typed input contract for the Card component.
 */
final class CardData
{
    public function __construct(
        public string $eyebrow = '',
        public string $heading = '',
        public string $subHeading = '',
        public string $meta = '',
        public string $content = '',
        public array $buttons = [],
        public array|ImageInterface|bool $image = false,
        public string $ratio = '16:9',
        public bool $collapsible = false,
        public ?array $tags = null,
        public string $link = '',
        public string $linkText = '',
        public array|bool $date = false,
        public bool $dateBadge = false,
        public bool $hasPlaceholder = false,
        public array|bool $icon = false,
        public ?string $iconBackgroundColor = null,
        public string $color = 'default',
        public bool $containerAware = false,
        public bool $metaFirst = false,
        public bool $headingAboveImage = false,
        public string $beforeContent = '',
        public string $afterContent = '',
        public string $floating = '',
        public string $aboveContent = '',
        public string $belowContent = '',
        public ?HtmlString $slot = null,
    ) {}
}
