<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Notice;

final class NoticeData
{
    public function __construct(
        public string $type = 'info',
        public array|object $message = ['title' => false, 'text' => false],
        public array|bool $icon = false,
        public bool $stretch = false,
        public bool|string $dismissable = false,
        public array|bool $action = false,
    ) {}
}
