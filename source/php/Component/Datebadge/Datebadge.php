<?php

namespace ComponentLibrary\Component\Datebadge;

class Datebadge extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
    }
}
