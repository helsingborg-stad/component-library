<?php

namespace ComponentLibrary\Component\Select;

class Select extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['id'] = empty($id) ?? uniqid();

        if ($multiple) {
            $this->data['attributeList']['multiple'] = 'multiple';
        }

        if ($name) {
            $this->data['attributeList']['name'] = $name;
        }

        if ($errorMessage) {
            $this->data['data-invalid-message'] = $errorMessage;
        }

        if ($required) {
            $this->data['attributeList']['required'] = 'required';
            $this->data['attributeList']['data-required'] = '1';
        }

        //Handle size
        if (!in_array($size, ['sm', 'md', 'lg'])) {
            $size = "md";
        }
        $this->data['classList'][] = $this->getBaseClass() . "--" . $size;
    }
}