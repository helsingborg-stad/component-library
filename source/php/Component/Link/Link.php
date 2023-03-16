<?php

namespace ComponentLibrary\Component\Link;

class Link extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Link
        if($href) {
            $this->data['attributeList']['href'] = $href;
        }

        //Target
        if($target) {
            $this->data['attributeList']['target'] = $target;
        }
    }
}
