<?php

namespace ComponentLibrary\Component\Brand;

use ComponentLibrary\Traits\ResolvesAspectRatio;

class Brand extends \ComponentLibrary\Component\BaseController
{
    use ResolvesAspectRatio;

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add class for logo
        if(!empty($logotype) && is_array($logotype)) {
            $this->data['logotype']['classList'][] = $this->getBaseClass("logotype"); 
        }

        //Normalize text
        if(!is_array($text) || empty($text)) {
            $this->data['text'] = false;
        }

        if(empty($text)) {
            $this->data['logotype']['attributeList'] = $attributeList; 
        }

        // Apply aspect-ratio style when a valid aspectRatio is provided
        $this->applyAspectRatioStyle($aspectRatio ?? null);

        // If aspectRatio is not provided, add default view box 
        if (empty($aspectRatio)) {
            $this->data['viewBox'] = ' viewBox="0 0 500 100" ';
        } else {
            $this->data['viewBox'] = '';
        }
    }
}
