<?php

namespace ComponentLibrary\Component\Collection__item;

class Collection__item extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['beforeSlotHasData'] = $this->slotHasData('before');
        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');

        if (!empty($displayIcon)) {
            $this->data['classList'][] = $this->getBaseClass('show-icon', true);
        }

        if (!empty($bordered)) {
            $this->data['classList'][] = $this->getBaseClass('bordered', true);
        }

        //Link handling
        if($link) {
            $this->data['componentElement'] = "a"; 
            $this->data['action'] = false; 
            $this->data['classList'][] = $this->getBaseClass() . '--action';
            $this->data['attributeList']['href'] = $link; 
		} else {
            $this->data['componentElement'] = "div"; 
        }
 
    }
}