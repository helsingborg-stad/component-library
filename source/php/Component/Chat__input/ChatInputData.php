<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Chat__input;

final class ChatInputData
{
    public function __construct(
        public ?string $placeholderText = null,
        public ?string $sendButtonText = null,
    ) {}
}
