<?php

namespace ComponentLibrary\Component\Modal;

class Modal extends \ComponentLibrary\Component\BaseController
{
	public function init() {

		//Extract array for eazy access (fetch only)
		extract($this->data);

		//Panel
		if($isPanel) {
			$this->data['classList'][] = $this->getBaseClass() . "--is-panel";
		} else {
			$this->data['classList'][] = $this->getBaseClass() . "--is-modal";
		}

		//The size
		if($size && in_array($size, ['sm','md','lg'])) {
			$this->data['classList'][] = $this->getBaseClass() . "--size-".$size;
		}

		//Padding
		if($padding && in_array($padding, range(0, 4))) {
			$this->data['classList'][] = $this->getBaseClass() . "--padding-".$padding;
		}

		//Border radius
		if($borderRadius && in_array($borderRadius, ['sm','md','lg'])) {
			$this->data['classList'][] = $this->getBaseClass() . "--border-radius-".$borderRadius;
		}

		//Ensure animation is present
		$animation ? $animation : $animation = "slide-down";

		$this->data['parentClass'][] = "c-modal__bg";

		if(isset($animation) && $animation) {
			$this->data['parentClass'][] = "c-modal__bg__animation--" . $animation;
		}

		$this->data['parentClass'] = implode(" ", $this->data['parentClass']);

		//die(var_dump( $this->data['parentClass']));

		//Overlay
		$this->data['classList'][] = $this->getBaseClass() . "--overlay-" . $overlay;
	}

}