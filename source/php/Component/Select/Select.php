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
            $this->data['id'] = uniqid();
        }
        $this->data['attributeList']['id'] = "select_{$id}";

        $this->data['classList'][] = $this->getBaseClass($size, true);

        if (!empty($multiple)) {
            $this->data['attributeList']['multiple'] = 'multiple';
        }

        $this->data['intersection'] = [];
        if (!empty($options) && is_array($preselected)) {
            // Create an associative array from $preselected with keys same as values
            $preselectedKeys = array_flip($preselected);

            // Check if $options contains any items that have the key of a $preselected value
            $this->data['intersection'] = array_intersect_key($options, $preselectedKeys);
        }

        if (!empty($name)) {
            $this->data['attributeList']['name'] = $name . (!empty($multiple) ? '[]' : '');
        }

        if (!empty($errorMessage)) {
            $this->data['data-invalid-message'] = $errorMessage;
        }

        if (!empty($required)) {
            $this->data['attributeList']['required'] = 'required';
            $this->data['attributeList']['data-required'] = '1';
        }
    }
}
