<?php

namespace ComponentLibrary\Component\Gallery;

class Gallery extends \ComponentLibrary\Component\BaseController
{
	public function init() {
		//Extract array for eazy access (fetch only)
		extract($this->data);

		if(isset($ariaLabels)) {
			$this->data['ariaLabels'] = $ariaLabels;
		}
	}

	public static function getUnique(){
		return uniqid();
	}
}
