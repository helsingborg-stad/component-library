<?php

namespace ComponentLibrary\Component\Textarea;

/**
 * Class Textarea
 * @package ComponentLibrary\Component\Textarea
 */
class Textarea extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        $this->compParams = [
            'label' => $label ?? '',
            'required' => $required ?? false,
            'invalidMessage' => $invalidMessage ?? '',
            'value' => $value ?? '',
        ];

        $this->setData();

        //Populate attributes
        $this->data['attributeList']['aria-multiline'] = "true"; 
        $this->data['attributeList']['placeholder'] = $label; 
        $this->data['attributeList']['aria-placeholder'] = $label; 

        //Is required props
        if($required) {
            $this->data['attributeList']['required'] = "required"; 
            $this->data['attributeList']['data-required'] = "1"; 
            $this->data['attributeList']['aria-required'] = "true"; 
        }
    }

    /**
     * Mapping data
     */
    public function setData()
    {
        $this->data['label'] = $this->compParams['label'];
        $this->data['required'] = $this->compParams['required'];
        $this->data['invalidMessage'] = $this->compParams['invalidMessage'];
        $this->data['value'] = $this->compParams['value'];

    }


}
