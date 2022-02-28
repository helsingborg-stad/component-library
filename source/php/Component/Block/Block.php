<?php

namespace ComponentLibrary\Component\Block;

/**
 * Class Block
 * @package ComponentLibrary\Component\Block
 */
class Block extends \ComponentLibrary\Component\BaseController
{
	public function init()
	{
		// Extract array for easy access (fetch only)
		extract($this->data);

		$this->data['collapseID'] = uniqid();

		if (isset($image['padded']) && $image['padded']) {
			$this->data['paddedImage'] = $this->getBaseClass() . '__image-background--padded';
		}

		if ($imageFirst) {
			$this->data['classList'][] = $this->getBaseClass() . '--image-first';
		}

		if ($hasAction) {
			$this->data['classList'][] = $this->getBaseClass() . '--action';
		}

		if ($filled) {
			$this->data['classList'][] = $this->getBaseClass() . '--filled';
		} else {
			$this->data['classList'][] = $this->getBaseClass() . '--default';
		}

		if ($image && !isset($image['backgroundColor'])) {
			$this->data['image']['backgroundColor'] = 'white';
		}

		if ($image && !isset($image['src'])) {
			$this->data['image'] = false;
		}

		if ($link) {
			$this->data['componentElement'] = "a";
		} else {
			$this->data['componentElement'] = "div";
		}

		if ($ratio) {
			$ratio = str_replace(":", "-", $ratio);
			$this->data['classList'][] = $this->getBaseClass() . '--ratio-' . $ratio;
		}
	}
}
