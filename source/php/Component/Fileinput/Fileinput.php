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

        //Error if display is unknown
        if(!in_array($display, ['button', 'area'])) {
            throw new \Exception('Invalid display type. Use "button" or "area".');
        }

        //Main type class modifier
        $this->data['classList'][] = $this->getBaseClass($display, true);
        $this->data['attributeList']['data-js-file-type'] = $display;

        if($filesMax) {
            $this->data['attributeList']['filesMax'] = $filesMax;
        }

        $this->data['required'] = $required ?? false;
    }
}
