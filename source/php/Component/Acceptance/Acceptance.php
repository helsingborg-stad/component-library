<?php

namespace ComponentLibrary\Component\Acceptance;

class Acceptance extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
     //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['isVideo'] = false; 

        $this->data['labels'] = $labels;
        $this->data['classList'][] = 'js-suppressed-content';

        if(isset($modifier)) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $modifier;
            $this->data['classList'][] =  'js-suppressed-content--' . $modifier;
            $this->data['isVideo'] = $modifier == 'video' ? true : false;
        } else {
            $this->data['classList'][] = 'js-suppressed-content' . '--none';
        }

        if(isset($height)) {
            $this->data['attributeList']['style'] = "height:" . $height . "px;"; 
        }

        if(isset($src)) {
            $this->data['attributeList']['data-src'] = $src;
        }

        if(isset($name)) {
            $this->data['attributeList']['data-supplier-name'] = $name;
        }
        if(isset($policy)) {
            $this->data['attributeList']['data-supplier-policy'] = $policy;
        }
        if(isset($host)) {
            $this->data['attributeList']['data-supplier-host'] = $host;
        }
    }
}
