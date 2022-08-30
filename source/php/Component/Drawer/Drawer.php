<?php

namespace ComponentLibrary\Component\Drawer;

class Drawer extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
     //Extract array for eazy access (fetch only)
        extract($this->data);
        
    }
}
