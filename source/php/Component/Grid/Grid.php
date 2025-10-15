<?php

namespace ComponentLibrary\Component\Grid;

class Grid extends \ComponentLibrary\Component\BaseController
{
	public function init() {
		//Extract array for eazy access (fetch only)
		extract($this->data);
	}
}
