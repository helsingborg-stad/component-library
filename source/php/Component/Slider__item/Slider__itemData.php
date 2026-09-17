<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Slider__item;

use ComponentLibrary\Integrations\Image\ImageInterface;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentSlot;

/**
 * Typed input contract for the Slider__item component.
 */
final class Slider__itemData
{
    public function __construct(
        public string|bool $title = '',
        public string|bool $text = '',
        public array|bool $cta = [],
        public bool|string|ImageInterface $image = false,
        public bool|string $video = false,
        public string $alt = '',
        public string|bool $link = false,
        public string $linkDescription = '',
        public string $layout = 'bottom',
        public string $theme = 'base',
        public string $containerColor = '',
        public string|bool $heroStyle = false,
        public string $textAlignment = '',
        public string $overlay = 'none',
        public string|HtmlString|ComponentSlot|null $slot = '',
        public bool|string $bottom = false,
    ) {}
}
