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

        if($shape == 'pill') {
            $this->data['classList'][] = $this->getBaseClass('pill', true);
        }

        if ($toggle) {
            $this->setToggleAttributes();
        }

        $this->setIconOnly($text, $icon);

        //Set type (submit etc.)
        if ($type) {
            $this->data['attributeList']['type'] = $type;
        }

        if($componentElement == 'label') {
            $this->data['isLabel'] = true;
        } else {
            $this->data['isLabel'] = false;
        }

        //Make linked buttons links
        if ($href) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $href;
        }

        if ($text) {
            $this->data['attributeList']['aria-label'] = $text;
        }

        if ($fullWidth) {
            $this->data['classList'][] = $this->getBaseClass() . '__full-width';
        }

        //Reversed positions
        if ($reversePositions) {
            if (!is_array($classListIcon) && empty($classListIcon)) {
                $classListIcon = [];
            }
            $classListIcon[] = $this->getBaseClass() . '__label-icon--reverse';
            if (!is_array($classListText) && empty($classListText)) {
                $classListText = [];
            }
            $classListText[] = $this->getBaseClass() . '__label-text--reverse';
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

        if(!empty($this->data['ariaLabel'])) {
            $this->data['attributeList']['aria-label'] = $this->data['ariaLabel'];
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

        if (!array_key_exists('data-js-toggle-trigger', $this->data['attributeList'])) {
            $this->data['attributeList']['data-js-toggle-trigger']   = $toggleId;
            $this->data['attributeList']['data-js-toggle-item']      = $toggleId;
            $this->data['attributeList']['data-js-toggle-class']     = "is-pressed";
            $this->data['attributeList']['aria-pressed']             = "false";
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
            $this->data['classList'][] = $this->getBaseClass('icon-only', true);
            
            if(!$this->data['ariaLabel'] && !isset($this->data['attributeList']['aria-label'])) {
                $this->data['attributeList']['aria-label'] = $icon;
            }
        }
    }
}
