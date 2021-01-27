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
    }
}
