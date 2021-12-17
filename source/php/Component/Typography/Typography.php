<?php

namespace ComponentLibrary\Component\Typography;

class Typography extends \ComponentLibrary\Component\BaseController
{

    private static $numberOfItems = 0;

    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //If this is the first heading of the page, promote it to h1
        if ($autopromote === true) {
            if (in_array($element, ['h1', 'h2', 'h3']) && self::$numberOfItems == 1) {
                $this->data['isPromotedHeading'] = true;
                $this->data['element'] = 'h1';
            } else {
                $this->data['isPromotedHeading'] = false;
            }

            if (substr($element, 0, 1) == 'h') {
                self::$numberOfItems++;
            }
        }

        //Variant
        $this->data['classList'][] = $this->getBaseClass() . "__variant--" . $variant;
    }
}
