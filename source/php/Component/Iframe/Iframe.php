<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        extract($this->data);

		if ($src) {
			$this->data['attributeList']['src'] = $src;
			$this->data['attributeList']['data-src'] = $src;
		}
		if ($title) {
			$this->data['attributeList']['title'] = $title;
		}
		if ($width) {
			$this->data['attributeList']['width'] = $width;
		}
		if ($height) {
			$this->data['attributeList']['height'] = $height;
		}

    }
}
