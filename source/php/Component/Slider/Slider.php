<?php

namespace ComponentLibrary\Component\Slider;

class Slider extends \ComponentLibrary\Component\BaseController implements SliderInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        $this->data['id'] = $this->sanitizeIdAttribute(uniqid("sider_", true));
        $this->data['attributeList']['data-step'] = 0;
        $this->data['attributeList']['data-js-slider'] = 0;
        $this->data['attributeList']['data-js-slider-index'] = 0;
        $this->data['attributeList']['data-js-slider-index'] = 0;

        if (!empty($repeatSlide)) {
            $this->data['attributeList']['data-slider-loop'] = true;
        }

        $this->data['classList'][] = 'splide';
        $this->data['classList'][] = 'u-visibility--visible';
        
        $ratio = preg_replace('/:/i', '-', $ratio);
        $this->data['classList'][] = 'c-slider--' . $ratio;

        $flatUiDesign = false;
        if (function_exists('get_theme_mod')) {
            $flatUiDesign = get_theme_mod('flat_ui_design');
        }

        if (!empty($padding)) {
            $this->data['attributeList']['data-slider-padding'] = $padding;
        }

        if (!empty($gap)) {
            $this->data['attributeList']['data-slider-gap'] = $gap;
        }

        if ($peekSlides) {
            $this->data['classList'][] = 'c-slider__peek';
        }

        if ($arrowButtons && (is_array($arrowButtons) || is_object($arrowButtons))) {
            $this->data['arrowButtons'] = (array) $arrowButtons;
        } else {
            $this->data['arrowButtons'] = false;
        }

        if ($navigationHover) {
            $this->data['classList'][] = 'c-slider__navigation--hover';
        }

        if ($autoSlide) {
            $delay = is_int($autoSlide) ? $autoSlide : 5;
            $this->data['attributeList']['data-js-slider__autoslide'] = $delay;
            $this->data['autoSlide'] = true;
        }

        if ($shadow && empty($flatUiDesign)) {
            $this->data['classList'][] = 'c-slider--shadow';
        }

        if ($showStepper) {
            $this->data['classList'][] = 'c-slider--has-stepper';
        }

        if ($heroStyle) {
            $this->data['classList'][] = $this->getBaseClass() . "--hero";
        }

        $this->data['attributeList']['data-js-slider-buttons'] = !empty($customButtons) ? $customButtons : $this->data['id'];
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'slider';
    }

    // -------------------------------------------------------------------------
    // SliderInterface — generated getters
    // -------------------------------------------------------------------------

    public function getShowStepper(): bool
    {
        return $this->data['showStepper'] ?? true;
    }

    public function getAutoSlide(): bool
    {
        return $this->data['autoSlide'] ?? true;
    }

    public function getPeekSlides(): bool
    {
        return $this->data['peekSlides'] ?? false;
    }

    public function getNavigationHover(): bool
    {
        return $this->data['navigationHover'] ?? true;
    }

    public function getRatio(): string
    {
        return $this->data['ratio'] ?? '16:9';
    }

    public function getRepeatSlide(): bool
    {
        return $this->data['repeatSlide'] ?? true;
    }

    public function getHeroStyle(): bool
    {
        return $this->data['heroStyle'] ?? false;
    }

    public function getShadow(): bool
    {
        return $this->data['shadow'] ?? true;
    }

    public function getCustomButtons(): bool
    {
        return $this->data['customButtons'] ?? false;
    }

    public function getArrowButtons(): object
    {
        return $this->data['arrowButtons'] ?? (object) [];
    }

    public function getPadding(): int
    {
        return $this->data['padding'] ?? 0;
    }

    public function getGap(): int
    {
        return $this->data['gap'] ?? 2;
    }
}
