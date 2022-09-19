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

        if(empty($this->data['id']) ) {
            $this->data['id'] = uniqid();
        }

        $this->compParams = [
            'label' => $label ?? '',
            'required' => $required ?? false,
            'invalidMessage' => $invalidMessage ?? '',
            'value' => $value ?? '',
            'checked' =>  $checked ?? false,
        ];

        $this->setData();

        //Handle size
        if (!in_array($size, ['sm', 'md', 'lg'])) {
            $size = "md";
        }
        $this->data['classList'][] = $this->getBaseClass() . "--" . $size;
    }

    /**
     * Mapping data
     */
    public function setData()
    {
        $this->data['label'] = $this->compParams['label'];
        $this->data['invalidMessage'] = $this->compParams['invalidMessage'];
        $this->data['value'] = $this->compParams['value'];
        $this->data['checked'] = $this->compParams['checked'];
        
        if ($this->compParams['required']) {
             $this->data['attributeList']['required'] = true;
        }
       
    }


}
