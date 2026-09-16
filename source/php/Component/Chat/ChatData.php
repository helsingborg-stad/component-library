<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Chat;

final class ChatData
{
    public function __construct(public ?string $title = null, public bool $persistent = false, public string $size = 'md', public array $chatInputData = [])
    {
    }
}
