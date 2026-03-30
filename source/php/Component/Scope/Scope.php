<?php

namespace ComponentLibrary\Component\Scope;

class Scope extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        if(!empty($this->data['name'])) {
            $this->data['attributeList']['data-scope'] = 's-' . $this->data['name'] ;
        }
    }
}
