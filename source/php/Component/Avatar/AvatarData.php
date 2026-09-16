<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Avatar;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Typed input contract for the Avatar component.
 */
final class AvatarData
{
    /**
     * @param string|ImageInterface|bool $image The profile image source.
     * @param array $icon Attributes for the nested Icon component.
     * @param string $name The person's full name.
     * @param string $size The avatar size.
     */
    public function __construct(
        public string|ImageInterface|bool $image = false,
        public array $icon = [],
        public string $name = '',
        public string $size = 'md',
    ) {
    }
}
