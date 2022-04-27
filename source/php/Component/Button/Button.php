<?php

namespace ComponentLibrary\Component\Button;

class Button extends \ComponentLibrary\Component\BaseController
{

	public function init()
	{

		//Extract array for eazy access (fetch only)
		extract($this->data);

		$styleClass = '__' . $style;
		$colorClass = '__' . $style . '--' . $color;

		$this->addToClassList(true, $styleClass, $colorClass);
		$this->setSize($text, $icon, $size);

		$this->data['attributeList']['type'] = $type;

		if ($toggle) {
			$this->setToggleAttributes();
		}

		if ($reversePositions) {
			$this->reversePositions();
		}

		$this->setIconOnly($text, $icon);

		if ($href) {
			$this->data['componentElement'] = "a";
		} else {
			$this->data['componentElement'] = "button";
			$this->data['attributeList']['aria-pressed'] = $pressed;
		}
	}

	/**
	 * Set attributes
	 *
	 * @return void
	 */
	private function setToggleAttributes()
	{
		$toggleId = uniqid('', true);

		if (!array_key_exists('js-toggle-trigger', $this->data['attributeList'])) {
			$this->data['attributeList']['js-toggle-trigger'] = $toggleId;
			$this->data['attributeList']['js-toggle-item'] = $toggleId;
		}

		$this->addToClassList(true, '__toggle');
	}

	/**
	 * Add one or more classes to the classlist
	 *
	 * @param Boolean $prependBaseClass Option to prepend the base class(c-button)
	 * @param Variadic ...$classList One or more css classes as strings
	 * @return void
	 */
	private function addToClassList($prependBaseClass, ...$classList)
	{
		foreach ($classList as $class) {

			if ($prependBaseClass) {
				$class = $this->getBaseClass() . $class;
			}

			$this->data['classList'][] = $class;
		}
	}

	/**
	 * Set the size, different class depending on content
	 *
	 * @param String $text The buttons text
	 * @param String $icon The name of the icon
	 * @param String $size The size of the button(sm, md, lg)
	 * @return void
	 */
	private function setSize($text, $icon, $size)
	{
		$class = (!$text && $icon) ? '__icon-size--' . $size : '--' . $size;

		$this->addToClassList(true, $class);
	}

	/**
	 * Adds modifier to indicate that this button is missing a label
	 *
	 * @param String $text The buttons text
	 * @param String $icon The name of the icon
	 * @return void
	 */
	private function setIconOnly($text, $icon)
	{
		if (!empty($icon) && empty($text)) {
			$this->addToClassList(true, '--icon-only');
		}
	}

	/**
	 * Reverse the positions of text and icon
	 *
	 * @return void
	 */
	private function reversePositions()
	{
		$this->data['labelMod'] = '--reverse';
	}
}
