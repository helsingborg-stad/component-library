<?php

namespace ComponentLibrary\Component\Header;

class Header extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

    }
}