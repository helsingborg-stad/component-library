<?php

namespace ComponentLibrary\Component\Notice;

class Notice extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        if (in_array($type, ['success', 'warning', 'danger', 'info'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $type;
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--info";
        }

        if ($stretch) {
            $this->data['classList'][] = $this->getBaseClass() . "--stretch";
        }

        //Avoid empty array items
        $this->data['message'] = array_merge(['title' => null, 'message' => null], $message);
    }
}
