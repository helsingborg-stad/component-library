<?php

namespace ComponentLibrary\Component\Drawer;

class Drawer extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
     //Extract array for eazy access (fetch only)
        extract($this->data);
        $data['searchSlotHasData'] = !empty($this->accessProtected($this->data['search'], "html"));
        $data['menuSlotHasData'] = !empty($this->accessProtected($this->data['menu'], "html"));
        
    }
}
