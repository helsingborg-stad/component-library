<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Signature;

/**
 * Typed input contract for the Signature component.
 */
final class SignatureData
{
    public function __construct(
        public string $author = '',
        public string $authorRole = '',
        public string $avatar = '',
        public string $avatar_size = 'md',
        public string $published = '',
        public string $updated = '',
        public string $link = '',
        public string $updatedLabel = 'Updated',
        public string $publishedLabel = 'Published',
        public bool $placeholderAvatar = true,
    ) {
    }
}
