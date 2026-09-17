<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Product;

/**
 * Typed input contract for the Product component.
 */
final class ProductData
{
    public function __construct(
        public string $heading = '',
        public string $backgroundColor = 'primary',
        public bool $image = false,
        public array $prices = [],
        public bool $currencyFirst = false,
        public string $label = '',
        public string $meta = '',
        public array $bulletPoints = [],
        public array $button = [],
        public bool $featured = false,
    ) {
    }
}