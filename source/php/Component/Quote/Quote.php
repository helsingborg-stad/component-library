<?php

namespace ComponentLibrary\Component\Quote;

class Quote extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        
        //Extract array for easy access (fetch only)
        extract($this->data);     
    }
}