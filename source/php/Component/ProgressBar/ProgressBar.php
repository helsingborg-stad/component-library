<?php

namespace ComponentLibrary\Component\ProgressBar;

class ProgressBar extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        //Extract array for easy access (fetch only)
        extract($this->data);

        $this->data['progressionValue'] = 'width:' . $value . '%;';

        if($isCancelled) {
            $this->data['classList'][] = $this->getBaseClass() . '--cancelled';
        }
     
    }
}