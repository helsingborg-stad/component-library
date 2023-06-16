<?php

namespace ComponentLibrary\Component\FilterSelect;

class FilterSelect extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);
        if ($shadow) {
            $this->data['classList'][] = $this->getBaseClass('shadow', true);
        }
    }
}
