<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

final class OptionData
{
    public function __construct(
        public string $type = 'checkbox',
        public string $label = '',
        public bool $required = false,
        public string $value = '',
        public bool $checked = false,
        public ?string $name = null,
    ) {}
}
