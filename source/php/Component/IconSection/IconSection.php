<?php

namespace ComponentLibrary\Component\IconSection;

class IconSection extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        $this->data['classList'][] =  $this->getBaseClass('gap-' . $gap, true);
    }
}
