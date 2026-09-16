<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Element;

/**
 * Typed input contract for the Element component.
 */
final class ElementData
{
    public function __construct(
        public string $componentElement = 'div',
        public bool $hideIfNoContent = true,
    ) {
    }
}
