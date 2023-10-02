<?php

namespace ComponentLibrary\Component\Select;

class Select extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Must include a id.
        if (empty($id)) {
            $id = $this->data['id'] = uniqid();
        }
        $this->data['attributeList']['id'] = "select_{$id}";

        //Set icon size
        $this->data['iconSize'] = $this->getIconSize($size); 

        //Declare select attribute list, use id predefined. 
        $this->data['selectAttributeList']['id'] = 'select_' . $this->data['id'];
        $this->data['selectAttributeList']['data-js-select-element'] = true;

        //Assign id
        $this->data['attributeList']['id'] = "{$id}";
        $this->data['attributeList']['data-js-toggle-item'] = $id . "-open-dropdown";
        $this->data['attributeList']['data-js-toggle-class'] = 'is-open';
        $this->data['attributeList']['data-js-select-component'] = 'true';
        $this->data['attributeList']['data-js-click-away'] = 'is-open';
        $this->data['attributeList']['data-js-is-empty-select'] = 'true';
        $this->data['attributeList']['data-js-device-detect'] = 'true';
        
        
        //Set general classes
        $this->data['classList'][] = $this->getBaseClass($size, true);

        if (!empty($multiple)) {
            $this->data['isMultiSelect'] = true;
            $this->data['classList'][] = $this->getBaseClass('multiselect', true);

            $this->data['selectAttributeList']['multiple'] = 'multiple';
            $this->data['selectAttributeList']['data-js-select-max'] = !empty($maxSelections) && is_numeric($maxSelections) ? $maxSelections : -1;
            $this->data['attributeList']['data-js-select-type'] = 'multiple';

            $this->data['itemStateIcons'] = (object) [
                'active'    => 'check_box', 
                'inactive'  => 'check_box_outline_blank',
            ]; 
        }

        if(empty($multiple)) {
            $this->data['isMultiSelect'] = false;
            $this->data['classList'][] = $this->getBaseClass('singleselect', true);

            $this->data['attributeList']['data-js-select-type'] = 'single';

            $this->data['itemStateIcons'] = (object) [
                'active'    => 'radio_button_checked', 
                'inactive'  => 'radio_button_unchecked',
            ]; 
        }

        $this->data['intersection'] = [];
        if (!empty($options) && is_array($preselected)) {
            // Create an associative array from $preselected with keys same as values
            $preselectedKeys = array_flip($preselected);

            // Check if $options contains any items that have the key of a $preselected value
            $this->data['intersection'] = array_intersect_key($options, $preselectedKeys);
        }

        if (!empty($name)) {
            $this->data['selectAttributeList']['name'] = $name . (!empty($multiple) ? '[]' : '');
        }

        if (!empty($errorMessage)) {
            $this->data['data-invalid-message'] = $errorMessage;
            $this->data['classList'][] = "has-invalid-message";  
        }

        if (!empty($required)) {
            $this->data['selectAttributeList']['required'] = 'required';
            $this->data['selectAttributeList']['aria-hidden'] = 'true';
            $this->data['selectAttributeList']['data-required'] = '1';
            $this->data['selectAttributeList']['aria-required'] = '1';
            
            $this->data['attributeList']['data-js-required'] = 'true';
            
            $this->data['classList'][] = "is-required";
        }

        $this->data['selectAttributes'] = self::buildAttributes(
            $this->data['selectAttributeList']
        );

        $this->data['clearButtonEnabled'] = empty($multiple) && empty($required);

        //Determine if this is selected
        $this->data['isSelected'] = function($key, $boolean = true)
        {
            if( $this->data['preselected'] === $key ) {
                return $boolean ? true : 'selected'; 
            }
            if(array_key_exists($key, $this->data['intersection'])) {
                return $boolean ? true : 'selected'; 
            }
            return $boolean ? false : '';
        };
    }

    private function getIconSize($fieldSize = 'md'): string
    {
        if($fieldSize == 'lg') {
            return 'md'; 
        }
        return $fieldSize; 
    }
}
