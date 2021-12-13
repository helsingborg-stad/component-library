<?php

namespace ComponentLibrary\Component\Imageinput;

class Imageinput extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        if ($display === 'area') {
            $this->data['classList'][] = 'c-imageinput--area';
        }

        if($filesMax) {
            $this->data['attributeList']['filesMax'] = $filesMax;
        }
    }
}
