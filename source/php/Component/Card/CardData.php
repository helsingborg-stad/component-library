<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\Integrations\Image\ImageInterface;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

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
        public string|bool $link = '',
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
        public string|ComponentSlot $beforeContent = '',
        public string|ComponentSlot $afterContent = '',
        public string|ComponentSlot $floating = '',
        public string|ComponentSlot $aboveContent = '',
        public string|ComponentSlot $belowContent = '',
        public string|HtmlString|ComponentSlot|null $slot = '',
    ) {}
}
