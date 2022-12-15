<?php

namespace ComponentLibrary\Component\Progress;

class Progress extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        //Extract array for easy access (fetch only)
        extract($this->data);
        
        $this->data['progressionValue'] = 'u-width--' . $value;
     
    }
}