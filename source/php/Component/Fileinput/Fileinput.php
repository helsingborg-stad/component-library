<?php

namespace ComponentLibrary\Component\Fileinput;

class Fileinput extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if(empty($this->data['id']) ) {
            $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
        }

        if($filesMax) {
            $this->data['attributeList']['data-js-file-max'] = $filesMax;
        }

        $this->data['attributeList']['data-js-file-is-multi'] = $multiple;

        $this->data['classList'][] = $this->getBaseClass('is-empty', true);

        $this->data['required'] = $required ?? false;
    }
}
