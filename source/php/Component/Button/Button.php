<?php

namespace ComponentLibrary\Component\Button;

class Button extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Basic classes
        $this->data['classList'][] = $this->getBaseClass() . '__' . $style;
        $this->data['classList'][] = $this->getBaseClass() . '__' . $style . '--' . $color;
        $this->data['classList'][] = $this->getBaseClass() . '--' . $size;

        if ($toggle) {
            $this->setToggleAttributes();
        }

        if ($reversePositions) {
            $this->reversePositions();
        }

        $this->setIconOnly($text, $icon);

        if ($type) {
            $this->data['attributeList']['type'] = $type;
        }

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

        $this->data['classList'][] = $this->getBaseClass() . '__toggle';
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
            $this->data['classList'][] = $this->getBaseClass() . '--icon-only';
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
