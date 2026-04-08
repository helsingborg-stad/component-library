<?php

namespace ComponentLibrary\Component\Scope;

class Scope extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        if(!empty($this->data['name'])) {
            if(is_array($this->data['name'])) {
                $this->data['name'] = array_filter($this->data['name']); 
                $this->data['name'] = implode(' s-', $this->data['name']); 
            }
            
            $this->data['attributeList']['data-scope'] = 's-' . $this->data['name'] ;
        }
    }
}
