<?php

namespace ComponentLibrary\Component\Header;

class Header extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if ($backgroundColor) {
            $this->data['classList'][] = "{$this->getBaseClass()}--{$backgroundColor}";
        }

        if ($textColor) {
            $this->data['classList'][] = "{$this->getBaseClass()}--text-{$textColor}";
        }

        if ($sticky) {
            $this->data['classList'][] = "{$this->getBaseClass()}--sticky";
        }

    }
}