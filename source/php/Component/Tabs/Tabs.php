<?php

namespace ComponentLibrary\Component\Tabs;

class Tabs extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Generate unique ID
        $this->data['id'] = uniqid();
    }
}
