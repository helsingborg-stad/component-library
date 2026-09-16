<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\InlineCssWrapper;

/**
 * Typed input contract for the InlineCssWrapper component.
 */
final class InlineCssWrapperData
{
    public function __construct(
        public string $componentElement = 'div',
        public array $styles = [],
    ) {
    }
}
