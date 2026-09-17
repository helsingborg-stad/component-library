<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Box;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Typed input contract for the Box component.
 */
final class BoxData
{
    /**
     * @param string $heading The box heading.
     * @param string $content The descriptive content.
     * @param string|array $meta The primary meta information.
     * @param string|array $secondaryMeta The secondary meta information.
     * @param string $link The optional target URL.
     * @param string $ratio The box aspect ratio.
     * @param string|array $date The preformatted date or Date component attributes.
     * @param bool|null $dateBadge Whether to display the date as a badge.
     * @param array|ImageInterface|bool $image The image source or Image component attributes.
     * @param string|array|bool $icon The icon name or Icon component attributes.
     */
    public function __construct(
        public string $heading = '',
        public string $content = '',
        public string|array $meta = '',
        public string|array $secondaryMeta = '',
        public string $link = '',
        public string $ratio = '1:1',
        public string|array $date = '',
        public ?bool $dateBadge = null,
        public array|ImageInterface|bool $image = false,
        public string|array|bool $icon = '',
    ) {}
}
