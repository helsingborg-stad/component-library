<?php

namespace ComponentLibrary\Component\Tooltip;

class Tooltip extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add classes
        $this->data['classList'][] = $this->getBaseClass() . '--'.$placement; 

        $this->data['attributeList']['original'] = $this->getBaseClass() . '--' . $placement; 
        $this->data['attributeList']['role'] = 'tooltip'; 
        
        if($label) {
            $this->data['attributeList']['aria-label'] = 'Tooltip: ' . $label; 
        }
    }
}
