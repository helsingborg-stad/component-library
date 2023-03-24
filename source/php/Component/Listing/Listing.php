<?php

namespace ComponentLibrary\Component\Listing;

class Listing extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (!empty($padding)) {
            $this->data['classList'][] = $this->getBaseClass('padding' . '-' . $padding, true);
        } 
    }
}