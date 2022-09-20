<?php

namespace ComponentLibrary\Component\Fileinput;

class Fileinput extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if(empty($this->data['id']) ) {
            $this->data['id'] = uniqid();
        }

        if ($display === 'area') {
            $this->data['classList'][] = 'c-fileinput--area';
        }
        
        if($filesMax) {
            $this->data['attributeList']['filesMax'] = $filesMax;
        }

        $this->data['required'] = $required ?? false;
    }
}
