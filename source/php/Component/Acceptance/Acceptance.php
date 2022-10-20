<?php

namespace ComponentLibrary\Component\Acceptance;

class Acceptance extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
     //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['labels'] = $labels;     

        if(isset($modifier)) {
            $this->data['classList'][] = $this->getBaseClass() . $modifier;
            
            if($modifier == '--video') {
                $this->data['isVideo'] = true;
            }
            else {
                $this->data['isVideo'] = false;
            }
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
