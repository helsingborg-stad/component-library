<?php

namespace ComponentLibrary\Component\Tooltip;

class Tooltip extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add classes
        $this->data['classList'][] = $this->getBaseClass() . '--'. $placement; 
        $this->data['classList'][] = $this->getBaseClass() . '--hidden'; 

        $this->data['attributeList']['original-placement'] = $this->getBaseClass() . '--' . $placement; 

        $this->data['id'] = $this->getUid();
        
    }
}
