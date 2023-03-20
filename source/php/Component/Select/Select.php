<?php

namespace ComponentLibrary\Component\Select;

class Select extends \ComponentLibrary\Component\BaseController
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Must include a id.
        if (!$id) {
            $id = $this->data['id'] = uniqid();
        }

        $this->data['classList'][] = $this->getBaseClass($size, true);

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

        if (function_exists('get_theme_mod') && get_theme_mod('field_style_settings') === "rounded") {
            $this->data['hideLabel'] = true;
        }
    }
}