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

		if ($image && !isset($image['backgroundColor'])) {
			$this->data['image']['backgroundColor'] = 'white';
		}

		if ($image && isset($image['src'])) {
			$this->data['attributeList']['style'] = 'background-image: url(' . $image['src'] . ')';
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
