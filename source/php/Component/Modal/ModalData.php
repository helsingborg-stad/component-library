<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Modal;

final class ModalData
{
    public function __construct(
        public string $heading = '',
        public string $slot = '',
        public string $bottom = '',
        public string $overlay = 'light',
        public bool $isPanel = false,
        public string $id = '',
        public string $animation = 'slide-up',
        public bool $navigation = false,
        public string $size = '',
        public int $padding = 3,
        public bool $borderRadius = false,
        public bool $transparent = false,
        public string $closeButtonText = '',
    ) {}
}
