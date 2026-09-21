<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Image;

use ComponentLibrary\Integrations\Image\ImageInterface;

final class ImageData
{
    public function __construct(
        public string|ImageInterface|bool|null $src = false,
        public string|bool $srcset = false,
        public ?string $alt = '',
        public string $caption = '',
        public bool $removeCaption = false,
        public string $byline = '',
        public bool $fullWidth = false,
        public bool $cover = false,
        public bool $rounded = false,
        public bool $placeholderEnabled = true,
        public string|bool $placeholderText = false,
        public string $placeholderIcon = 'broken_image',
        public string $placeholderIconSize = 'xxl',
        public array $imgAttributeList = [],
        public bool $lqipEnabled = true,
        public bool $calculateAspectRatio = true,
        public bool $preferSrcset = false,
    ) {}
}
