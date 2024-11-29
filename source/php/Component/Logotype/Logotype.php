<?php

namespace ComponentLibrary\Component\Logotype;

class Logotype extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add placeholder class
        if(!$src) {
            $this->data['classList'][] = $this->getBaseClass() . "--is-placeholder";
        }

        //Inherit the alt text
        if(!$alt && $caption) {
            $this->data['alt'] = $this->data['caption'];
        }
    }
}
