<?php

namespace ComponentLibrary\Component\Code;

class Code extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Escape
        if($escape) {
            $this->data['slot'] = htmlentities($slot); 
        }

        $language = ($language) ? $language : 'php';

    }
}
