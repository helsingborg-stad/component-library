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
        if ($type && in_array($type, ['button', 'submit', 'reset']) && in_array($componentElement, ['button', 'input'])) {
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

        if ($ariaLabel || $text) {
            $this->data['attributeList']['aria-label'] = $ariaLabel ? $ariaLabel : $text;
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

        if (empty($disableColor)) {
            $this->data['classList'][] = $this->getBaseClass('no-disabled-color', true);
        }
    }

    /**
     * Set attributes, if not found in attributes list.
     * Attributes may be overridden with attributes from
     * the attributeList input. 
     *
     * @return void
     */
    private function setToggleAttributes()
    {
        $toggleId = uniqid('', true);

        $attributeMap = [
            //'data-js-toggle-trigger' => $toggleId,
            //'data-js-toggle-item' => $toggleId,
            //'data-js-toggle-class' => "is-pressed", 
            'aria-pressed' => "false"
        ];

        foreach($attributeMap as $attribute => $data) {
            if (!array_key_exists($attribute, $this->data['attributeList']) || empty($this->data['attributeList'])) {
                $this->data['attributeList'][$attribute] = $data;
            }
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
