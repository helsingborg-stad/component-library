<?php

namespace ComponentLibrary\Component\Typography;

class Typography extends \ComponentLibrary\Component\BaseController
{

    private static $numberOfItems = 0;
    private static $headingExists = false;

    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Set default
        $this->data['isPromotedHeading'] = false;

        //If this is the first heading of the page, promote it to h1
        if ($element = 'h1') {
            if (!empty(self::$headingExists)) {
                $this->data['element'] = 'h2';
            } else {
                self::$headingExists = true;
            }
        }

        if ($autopromote === true && !empty(self::$autopromote)) {
            if (in_array($element, ['h1', 'h2', 'h3']) && self::$numberOfItems == 0) {
                $this->data['isPromotedHeading'] = true;
                $this->data['element'] = 'h1';
            }

            if (substr($element, 0, 1) == 'h') {
                self::$numberOfItems++;
            }
        }

        //Variant
        $this->data['classList'][] = $this->getBaseClass() . "__variant--" . $variant;
    }
}
