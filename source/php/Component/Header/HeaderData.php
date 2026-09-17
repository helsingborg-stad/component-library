<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Header;

final class HeaderData
{
    public function __construct(
        public string $componentElement = 'header',
        public ?string $id = null,
        public string|bool $textColor = false,
        public string|bool $backgroundColor = false,
        public bool $sticky = false,
    ) {}
}
