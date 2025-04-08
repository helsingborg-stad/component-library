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

        $this->data['attributeList']['data-js-file'] = "dropzone";

        if(($filesMax > 1) && $multiple) {
            $this->data['attributeList']['data-js-file-max'] = $filesMax;
        }

        if(!$multiple) {
            $this->data['attributeList']['data-js-file-max'] = 1;
        }

        $this->data['attributeList']['data-js-file-is-multi'] = $multiple;

        $this->data['classList'][] = "is-empty";

        $this->data['required'] = $required ?? false;
    }
}
