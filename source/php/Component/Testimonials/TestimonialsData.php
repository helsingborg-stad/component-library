<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Testimonials;

final class TestimonialsData
{
    public function __construct(public string $componentElement = 'div', public array $testimonials = [], public int $perRow = 4, public bool $isCarousel = false, public int $slidesPerPage = 2)
    {
    }
}
