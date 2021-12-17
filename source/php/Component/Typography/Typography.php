<?php

namespace ComponentLibrary\Component\Typography;

class Typography extends \ComponentLibrary\Component\BaseController
{

    private static $numberOfItems = 0;

    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Set default
        $this->data['isPromotedHeading'] = false;

        //If this is the first heading of the page, promote it to h1
        if ($autopromote === true) {
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
