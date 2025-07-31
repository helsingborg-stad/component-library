<?php

namespace ComponentLibrary\Component\Fileinput;

class Fileinput extends \ComponentLibrary\Component\BaseController
{
    private $filesMax = 50;

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if(empty($this->data['id']) ) {
            $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
        }

        if ($preview) {
            $this->data['classList'][] = $this->getBaseClass('preview', true);
            $this->data['attributeList']['data-js-file-preview'] = true;
        }

        // Set as dropzone
        $this->data['attributeList']['data-js-file'] = "dropzone";

        // Set 10 as default max files, when multiple
        if($multiple) {
            $this->data['filesMax'] = $filesMax = $filesMax != 1 ? $filesMax : 10;
            $this->data['attributeList']['data-js-file-max'] = $filesMax;
        }

        // If multiple is false, set max files to 1
        if(!$multiple) {
            $this->data['filesMax'] = 1;
            $this->data['attributeList']['data-js-file-max'] = 1;
        }

        // Do not allow -1 as max files, or more than $this->filesMax
        if($multiple && ($filesMax == -1 || $filesMax > $this->filesMax)) {
            $this->data['filesMax'] = $this->filesMax;
            $this->data['attributeList']['data-js-file-max'] = $this->filesMax;
        }

        // Indicate multiple or not
        $this->data['attributeList']['data-js-file-is-multi'] = $multiple;

        // Set class empty
        $this->data['classList'][] = "is-empty";

        // Set required attribute
        $this->data['required'] = $required ?? false;
    }
}
