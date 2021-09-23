<?php

namespace ComponentLibrary\Component\Hero;

class Hero extends \ComponentLibrary\Component\BaseController
{
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Create image style tag
        $this->data['imageStyle'] = []; 

        //Add image to image styles
        if($image) {
            $this->data['imageStyle']['background-image'] = "url('" . $image . "')"; 
        }

        //Add background position to image styles
        if(isset($imageFocus) && is_array($imageFocus) && array_filter($imageFocus)) {
            $this->data['imageStyle']['background-position'] = $imageFocus['left'] . "% " . $imageFocus['top'] . "%"; 
        }

        //Stringify image styles
        $this->data['imageStyleString'] = self::buildInlineStyle($this->data['imageStyle']); 

        //Font color
        if($color) {
            $this->data['classList'][] = $this->getBaseClass() . '--text-' . $color; 
        }

        //Ratio
        if($size) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $size; 
        }

        //Overlay
        if($overlay) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay-' . $overlay; 
        }

    }
}