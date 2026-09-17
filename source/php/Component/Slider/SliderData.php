<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Slider;

final class SliderData
{
    public function __construct(
        public bool|int|null $autoSlide = true,
        public bool $peekSlides = false,
        public bool $navigationHover = true,
        public string $ratio = '16:9',
        public bool $repeatSlide = true,
        public string $type = 'slide',
        public bool $heroStyle = false,
        public bool $shadow = true,
        public string|bool $customButtons = false,
        public array $arrowButtons = ['color' => 'primary', 'style' => 'filled'],
        public int $padding = 0,
        public int $gap = 2,
    ) {}
}
