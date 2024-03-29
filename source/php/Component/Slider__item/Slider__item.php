<?php

namespace ComponentLibrary\Component\Slider__item;

class Slider__item extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

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

        if (!empty($desktop_image)) {
            $this->data['attributeList']['style'] = "background-image: url('".$desktop_image."');";
        }

        $this->data['showContainer'] = false;
        if (!empty($title) || !empty($sub_title) ||!empty($text) || !empty($bottom)) {
            $this->data['showContainer'] = true;
        }

        if ($overlay && ($text || $title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay-' . $overlay;
        }

        if (!empty($alt) && empty($altMobile)) {
            $this->data['altMobile'] = $alt;
        }

        if ($heroStyle) {
            $this->data['classList'][] = $this->getBaseClass() . "--hero";
        }

        
        //Recognize as an image
        if(!$background_video) {
            $this->data['attributeList']['aria-label'] = $alt ? $alt : '';
            $this->data['attributeList']['aria-labeledby'] = $this->getUid() . '__heading';
        }
        
        if(!empty($focusPoint)) {

            //Create image style tag
            $this->data['imageStyle'] = []; 

            //Add image to image styles
            if($desktop_image) {
                $this->data['imageStyle']['background-image'] = "url('" . $desktop_image . "')"; 
            }

            //Add background position to image styles
            if(is_array($focusPoint) && array_filter($focusPoint)) {
                $this->data['imageStyle']['background-position'] = $focusPoint['left'] . "% " . $focusPoint['top'] . "%"; 
            }

            //Stringify image styles
            $this->data['attributeList']['style'] = self::buildInlineStyle($this->data['imageStyle']); 
        }
    }
}
