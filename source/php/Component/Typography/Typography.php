<?php

namespace ComponentLibrary\Component\Typography;

class Typography extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        //Extract array for easy access (fetch only)
        extract($this->data);

        //Variant
        $this->data['classList'][] = $this->getBaseClass() . "__variant--" . $variant;
    }
}