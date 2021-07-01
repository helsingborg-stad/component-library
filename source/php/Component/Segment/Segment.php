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

        //Handle image based on view 
        if (filter_var($image, FILTER_VALIDATE_URL) && $layout == 'full-width') {
            // Overlay
            if ($overlay) {
                $this->data['classList'][] = 'c-segment--overlay-' . $overlay;
            }
        }

        //Stringify image classlist
        $this->data['imageClass'] = implode("" , $this->data['imageClassList']); 

        // Handle background data
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