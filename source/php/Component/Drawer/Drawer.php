<?php

namespace ComponentLibrary\Component\Drawer;

class Drawer extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
     //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['searchSlotHasData'] = array_key_exists('search', $this->data) && !empty($this->accessProtected($this->data['search'], "html"));

        $this->data['menuSlotHasData'] = array_key_exists('menu', $this->data) && !empty($this->accessProtected($this->data['menu'], "html"));
        
    }
}
