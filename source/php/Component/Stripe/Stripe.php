<?php

namespace ComponentLibrary\Component\Stripe;

class Stripe extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['attributeList']['aria-hidden'] = "true"; 
    }
}
