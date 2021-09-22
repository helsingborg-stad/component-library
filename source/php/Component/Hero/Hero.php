<?php

namespace ComponentLibrary\Component\Hero;

class Hero extends \ComponentLibrary\Component\BaseController
{
    public function init() {


        die("test"); 

        
        //Extract array for eazy access (fetch only)
        extract($this->data);


        $this->data['test'] = "test"; 

        //$this->getBaseClass()
      
    }
}