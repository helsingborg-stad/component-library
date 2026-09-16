<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Loader;

/**
 * Typed input contract for the Loader component.
 */
final class LoaderData
{
    public function __construct(
        public string $componentElement = 'div',
        public string $shape = 'circular',
        public string $size = 'md',
        public string $color = 'black',
        public string $text = '',
    ) {
    }
}
