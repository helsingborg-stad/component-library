<?php

namespace ComponentLibrary\Component\Gallery;

class Gallery extends \ComponentLibrary\Component\BaseController
{
	public function init() {
		//Extract array for eazy access (fetch only)
		extract($this->data);
	}

	public static function getUnique(){
		return uniqid();
	}
}
