<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Typography;

final class TypographyData
{
    public function __construct(public string $element = 'p', public string|bool $variant = false, public string $slot = '', public bool $autopromote = false, public bool $useHeadingsContext = true)
    {
    }
}
