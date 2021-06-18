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

        // Remove padding
        if (!$paddingTop) {
            $this->data['classList'][] = 'u-padding__top--0';
        }

        if (!$paddingBottom) {
            $this->data['classList'][] = 'u-padding__bottom--0';
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

        // Text Alignment
        if ($reverseColumns) {
            $this->data['classList'][] = 'c-segment--reverse';
        }


        // Handle background data
        if ($background) {
            if (filter_var($background, FILTER_VALIDATE_URL)) {
                $this->data['image'] = $background;

                // Overlay
                if ($overlay) {
                    $this->data['classList'][] = 'c-segment--overlay-' . $overlay;
                }
            }
            else if (preg_match('^#(?:[0-9a-fA-F]{3}){1,2}$^', $background)) {
                $this->data['attributeList']['style'] = 'background-color: ' . $background . ';';
            }
            else {
                $this->data['classList'][] = 'c-segment--background-' . $background;
            }
        }

    }
}