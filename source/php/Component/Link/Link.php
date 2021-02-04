<?php

namespace ComponentLibrary\Component\Link;

class Link extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Default link
        if(!$href) {
            $this->data['href'] = "";
        }

        if($href) {
            $this->data['attributeList']['role'] = "link";
        }
    }
}
