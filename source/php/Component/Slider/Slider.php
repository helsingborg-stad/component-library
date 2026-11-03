<?php

namespace ComponentLibrary\Component\Slider;

class Slider extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        $this->data['id'] = $this->sanitizeIdAttribute(uniqid('slider_', true));
        $this->data['attributeList']['data-step'] = 0;
        $this->data['attributeList']['data-js-slider'] = 0;
        $this->data['attributeList']['data-js-slider-index'] = 0;
        $this->data['attributeList']['data-js-slider-index'] = 0;

        $this->data['classList'][] = 'u-visibility--visible';

        $ratio = preg_replace('/:/i', '-', $ratio);
        $this->data['classList'][] = 'c-slider--' . $ratio;

        $flatUiDesign = false;
        if (function_exists('get_theme_mod')) {
            $flatUiDesign = get_theme_mod('flat_ui_design');
        }

        $existingStyle = (string) ($this->data['attributeList']['style'] ?? '');
        $configuredSlidesPerPage = (int) ($this->data['attributeList']['data-slides-per-page'] ?? $slidesPerPage);
        $configuredSlidesPerPage = max(1, $configuredSlidesPerPage);
        $sliderVariables = sprintf(
            '--c-slider--configured-columns: %1$d; --c-slider--columns-1: 1; --c-slider--columns-2: %2$d; --c-slider--columns-3: %3$d; --c-slider--columns-4: %4$d; --c-slider--gap: %5$dpx; --c-slider--padding: %6$dpx;',
            $configuredSlidesPerPage,
            min($configuredSlidesPerPage, 2),
            min($configuredSlidesPerPage, 3),
            min($configuredSlidesPerPage, 4),
            max(0, $gap) * 8,
            max(0, $padding) * 8,
        );
        $this->data['attributeList']['style'] = trim($existingStyle . ' ' . $sliderVariables);

        if ($slideByPage) {
            $this->data['attributeList']['data-js-slider-slide-by-page'] = 'true';
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

        if ($compactNavigation) {
            $this->data['classList'][] = 'c-slider--compact-navigation';
        }

        if ($title) {
            $this->data['classList'][] = 'c-slider--has-title';
        }

        if ($title || $preamble) {
            $this->data['classList'][] = 'c-slider--has-header';
        }

        if ($autoSlide) {
            $delay = is_int($autoSlide) ? $autoSlide : 5;
            $this->data['attributeList']['data-js-slider__autoslide'] = $delay;
            $this->data['autoSlide'] = true;
        }

        if ($shadow && empty($flatUiDesign)) {
            $this->data['classList'][] = 'c-slider--shadow';
        }

        if ($heroStyle) {
            $this->data['classList'][] = $this->getBaseClass() . '--hero';
        }

        $this->data['attributeList']['data-js-slider-buttons'] = !empty($customButtons)
            ? $customButtons
            : $this->data['id'];
    }
}
