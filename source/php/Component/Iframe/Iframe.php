<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        extract($this->data);
		
		if($src) {
            $this->data['attributeList']['data-src'] = $src;
        }
	}
}
