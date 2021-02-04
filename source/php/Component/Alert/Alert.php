<?php

namespace ComponentLibrary\Component\Alert;

/**
 * Class Alert
 * @package ComponentLibrary\Component\Alert
 */
class Alert extends \ComponentLibrary\Component\BaseController  
{
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Overlay
        $this->data['classList'][] = $this->getBaseClass() . "--overlay-" . $overlay; 
    }
}