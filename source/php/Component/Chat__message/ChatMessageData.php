<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Chat__message;

final class ChatMessageData
{
    public function __construct(
        public bool $isReply = false,
    ) {}
}
