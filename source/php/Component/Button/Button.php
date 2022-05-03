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

        $this->setIconOnly($text, $icon);

        //Set type (submit etc.)
        if ($type) {
            $this->data['attributeList']['type'] = $type;
        }

        //Make linked buttons links
        if ($href) {
            $this->data['componentElement'] = "a";
        } else {
            $this->data['componentElement'] = "button";
            $this->data['attributeList']['aria-pressed'] = $pressed;
        }
      
        if($fullWidth) {
            $this->data['classList'][] = $this->getBaseClass() . '__full-width';
        }

        //Reversed positions
        if ($reversePositions && is_array($classListIcon)) {
            $classListIcon[] = $this->getBaseClass() . '--reverse';
        }
        if ($reversePositions && is_array($classListText)) {
            $classListText[] = $this->getBaseClass() . '--reverse';
        }

        //Add classes to ico
        if (is_array($classListIcon) && !empty($classListIcon)) {
            $this->data['classListIcon'] = implode(" ", $classListIcon);
        } else {
            $this->data['classListIcon'] = "";
        }

        //Add classes to text
        if (is_array($classListText) && !empty($classListText)) {
            $this->data['classListText'] = implode(" ", $classListText);
        } else {
            $this->data['classListText'] = "";
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
}
