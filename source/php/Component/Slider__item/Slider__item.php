<?php

namespace ComponentLibrary\Component\Slider__item;

class Slider__item extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData'] = $this->slotHasData('slot');

        $this->data['classListDesktop'] = $this->getBaseClass() . "__image";
        $this->data['classList'][] = 'splide__slide';

        if (!empty($containerColor)) {
            $this->data['classList'][] = 'u-color__bg--' . $containerColor;
        }

        if (!empty($textAlignment)) {
            $this->data['classList'][] = $this->getBaseClass() . "--text-align-" . $textAlignment;
        }

        if (!empty($textColor)) {
            $this->data['classList'][] = $this->getBaseClass() . "--text-" . $textColor;
        }

        if (!empty($layout)) {
            $this->data['classList'][] = $this->getBaseClass() . "--layout-" . $layout;
        }

        $this->data['showContainer'] = false;
        if (!empty($title) || !empty($subTitle) ||!empty($text) || !empty($bottom)) {
            $this->data['showContainer'] = true;
        }

        if ($overlay && ($text || $title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay-' . $overlay;
        }

        if (!empty($alt)) {
            $this->data['alt'] = $alt;
        }

        if ($heroStyle) {
            $this->data['classList'][] = $this->getBaseClass() . "--hero";
        }
    }
}
