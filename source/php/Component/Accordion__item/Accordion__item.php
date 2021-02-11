<?php

namespace ComponentLibrary\Component\Accordion__item;

/**
 * Class Accordion
 * @package ComponentLibrary\Component\Accordion
 */
class Accordion__item extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        
        extract($this->data);
        $this->data['baseClass'] = 'c-accordion';
        $this->data['id'] = uniqid();

        $this->data['headingType'] = ( isset($this->heading) && is_array($this->heading) ) ? $this->data['baseClass'] . '__heading-is-array' : '';

    }
}
