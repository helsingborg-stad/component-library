<?php

namespace ComponentLibrary\Component\Brand;

class Brand extends \ComponentLibrary\Component\BaseController implements BrandInterface
{

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
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'brand';
    }

    // -------------------------------------------------------------------------
    // BrandInterface — generated getters
    // -------------------------------------------------------------------------

    public function getLogotype(): array
    {
        return $this->data['logotype'] ?? [];
    }

    public function getText(): array
    {
        return $this->data['text'] ?? [];
    }
}
