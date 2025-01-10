<?php

namespace ComponentLibrary\Component\Toast;

class Toast extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Set the position class
        if(in_array($this->data['position'], ['top-left', 'top-right', 'bottom-left', 'bottom-right'])) {
            $this->data['classList'][] = $this->getBaseClass(
                $this->data['position'], true
            );
        }
    }
}
