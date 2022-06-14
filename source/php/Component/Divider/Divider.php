<?php

namespace ComponentLibrary\Component\Divider;

/**
 * Class Dropdown
 * @package ComponentLibrary\Component\Dropdown
 */
class Divider extends \ComponentLibrary\Component\BaseController
{

    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if($style) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $style;
        }

        if($size) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $size;
        }

        if($align) {
            $this->data['classList'][] = $this->getBaseClass() . '--align-' . $align;
        }

        if($frame) {
            $this->data['classList'][] = $this->getBaseClass() . '--has-frame';
        }

        if($customFont) {
            $this->data['classList'][] = $this->getBaseClass() . '--custom-font';
        }

        if(empty($title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--without-title';
        }
    }
}
