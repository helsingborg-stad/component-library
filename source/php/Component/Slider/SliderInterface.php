<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Slider;

use ComponentLibrary\Component\ComponentInterface;

interface SliderInterface extends ComponentInterface
{
    /**
     * Option to hide or show stepper.
     */
    public function getShowStepper(): bool;

    /**
     * If set to true, slider will auto slide with default delay. Can also receive an int to set delay in seconds.
     */
    public function getAutoSlide(): bool;

    /**
     * Adds some padding to show a peek of next and previous slides.
     */
    public function getPeekSlides(): bool;

    /**
     * Only show navigation when hovering over the slider.
     */
    public function getNavigationHover(): bool;

    /**
     * The size ratio of the slider.
     */
    public function getRatio(): string;

    /**
     * Will allow the slide to repeat its cycle.
     */
    public function getRepeatSlide(): bool;

    /**
     * HeroStyle.
     */
    public function getHeroStyle(): bool;

    /**
     * Shadow.
     */
    public function getShadow(): bool;

    /**
     * False will use default buttons, otherwise pass a string of the value of data-js-slider-buttons.
     */
    public function getCustomButtons(): bool;

    /**
     * ArrowButtons.
     */
    public function getArrowButtons(): object;

    /**
     * Sets the amount of padding between slides.
     */
    public function getPadding(): int;

    /**
     * Sets the amount of gap between slides.
     */
    public function getGap(): int;

}
