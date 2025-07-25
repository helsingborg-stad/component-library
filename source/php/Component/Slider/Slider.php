<?php

namespace ComponentLibrary\Component\Slider;

class Slider extends \ComponentLibrary\Component\BaseController
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
}
