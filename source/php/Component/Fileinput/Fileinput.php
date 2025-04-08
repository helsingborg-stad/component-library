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

        // Set as dropzone
        $this->data['attributeList']['data-js-file'] = "dropzone";

        // Set 10 as default max files, when multiple
        if($multiple) {
            $this->data['attributeList']['data-js-file-max'] = $filesMax != 1 ? $filesMax : 10;
        }

        // If multiple is false, set max files to 1
        if(!$multiple) {
            $this->data['attributeList']['data-js-file-max'] = 1;
        }

        // Indicate multiple or not
        $this->data['attributeList']['data-js-file-is-multi'] = $multiple;

        // Set class empty
        $this->data['classList'][] = "is-empty";

        // Set required attribute
        $this->data['required'] = $required ?? false;
    }
}
