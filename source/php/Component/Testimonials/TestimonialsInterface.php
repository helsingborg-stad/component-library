<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Testimonials;

use ComponentLibrary\Component\ComponentInterface;

interface TestimonialsInterface extends ComponentInterface
{
    /**
     * The tag for the component.
     */
    public function getComponentElement(): string;

    /**
     * List containing testimonial items.
     */
    public function getTestimonials(): array;

    /**
     * Number of columns per row. Must be integer divisible by 12.
     */
    public function getPerRow(): int;

    /**
     * If there should be a carousel between for the testimonials.
     */
    public function getIsCarousel(): bool;

    /**
     * Number of items per slide, if carousel is true.
     */
    public function getSlidesPerPage(): int;

}
