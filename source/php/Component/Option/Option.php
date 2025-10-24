<?php

namespace ComponentLibrary\Component\Option;

/**
 * Class Option
 * @package ComponentLibrary\Component\Option
 */
class Option extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $id = $this->data['id'] = $this->sanitizeIdAttribute(!empty($this->data['id']) ? $this->data['id'] : uniqid());

        if (!empty($name)) {
            $this->data['attributeList']['name'] = $name;
        } else if (!empty($this->data['attributeList']['name'])) {} else {
            $this->data['attributeList']['name'] = $label;
        }

        if (!empty($required)) {
             $this->data['attributeList']['required'] = true;
        }

        if (empty($value) && !empty($this->data['attributeList']['value'])) {
            $this->data['value'] = $this->data['attributeList']['value'];
        }
    }
}