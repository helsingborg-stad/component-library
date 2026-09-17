<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Toast;

final class ToastData
{
    public function __construct(
        public string $position = 'bottom-left',
    ) {}
}
