<?php

namespace ComponentLibrary\Component\Form;

/**
 * Class Form
 * @package ComponentLibrary\Component\Form
 */
class Form extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        //Id always required
        if (!$id) {
            $this->data['id'] = uniqid();
        }

        //Add validation class as default
        if ($validation) {
            $this->data['classList'][] = 'js-form-validation';
        }

    }
}