<?php

namespace ComponentLibrary\Component\FilterSelect;

class FilterSelect extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);
    }
}