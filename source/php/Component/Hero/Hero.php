<?php

namespace ComponentLibrary\Component\Hero;

class Hero extends \ComponentLibrary\Component\BaseController
{
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        if ($stretch) {
            $this->data['classList'][] = $this->getBaseClass() . "--stretch";
        }

        //Create image style tag
        $this->data['imageStyle'] = [];

        //Add image to image styles
        if ($image) {
            $this->data['imageStyle']['background-image'] = "url('" . $image . "')";
        }

        //Add background position to image styles
        if (isset($imageFocus) && is_array($imageFocus) && array_filter($imageFocus)) {
            $this->data['imageStyle']['background-position'] = $imageFocus['left'] . "% " . $imageFocus['top'] . "%";
        }

        //Stringify image styles
        $this->data['imageStyleString'] = self::buildInlineStyle($this->data['imageStyle']);

        //Ratio
        if ($size) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $size;
        }

        //Overlay
        if ($title || $paragraph || $byline) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay';
            $this->data['overlay'] = true;
        } else {
            $this->data['overlay'] = false;
        }

    }
}