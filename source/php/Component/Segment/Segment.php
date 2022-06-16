<?php

namespace ComponentLibrary\Component\Segment;

class Segment extends \ComponentLibrary\Component\BaseController
{

    public function init()
    {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Set the layout
        if ($layout) {
            $this->data['classList'][] = 'c-segment--' . $layout;
        }

        $this->data['imageClassList'] = [];

        // Remove padding
        if (!$paddingTop) {
            $this->data['classList'][] = 'u-padding__top--0';
            $this->data['imageClassList'][] = 'u-margin__top--0'; 
        }

        if (!$paddingBottom) {
            $this->data['classList'][] = 'u-padding__bottom--0';
            $this->data['imageClassList'][] = 'u-margin__bottom--0'; 
        }

        // Set text color
        if ($stretch) {
            $this->data['classList'][] = 'c-segment--stretch';
        }

        // Set text color
        if ($textColor) {
            $this->data['classList'][] = 'c-segment--text-' . $textColor;
        }

        // Height
        if ($height) {
            $this->data['classList'][] = 'c-segment--height-' . $height;
        }

        // Text Size
        if ($textSize) {
            $this->data['classList'][] = 'c-segment--text-' . $textSize;
        }

        // Text Alignment
        if ($textAlignment) {
            $this->data['classList'][] = 'c-segment--alignment-' . $textAlignment;
        }

        // Column reverse
        if ($reverseColumns) {
            $this->data['classList'][] = 'c-segment--reverse';
        }

        // Add overlay class
        if ($layout === 'full-width' && ($title||$content) && !empty($image)) {
            $this->data['classList'][] = 'c-segment' . '--has-overlay';
        }

        //Stringify image classlist
        $this->data['imageClass'] = implode("" , $this->data['imageClassList']);

        //Create image style tag
        $this->data['imageStyle'] = [];

        //Add image to image styles
        if ($image) {
            $this->data['imageStyle']['background-image'] = "url('" . $image . "')"; 
        }

        //Add background position to image styles
        if(array_filter($imageFocus)) {
            $this->data['imageStyle']['background-position'] = $imageFocus['left'] . "% " . $imageFocus['top'] . "%"; 
        }

        //Stringify image styles
        $this->data['imageStyleString'] = self::buildInlineStyle($this->data['imageStyle']); 

        // Handle background data (wrapper)
        if ($background) {
            if (preg_match('^#(?:[0-9a-fA-F]{3}){1,2}$^', $background)) {
                $this->data['attributeList']['style'] = 'background-color: ' . $background . ';';
            }
            else {
                $this->data['classList'][] = 'u-color__bg--' . $background;
            }
        }

    }
}