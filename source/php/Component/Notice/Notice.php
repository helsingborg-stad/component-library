<?php

namespace ComponentLibrary\Component\Notice;

class Notice extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (empty($id)) {
            $this->data['id'] = uniqid();
        }
     
        if (in_array($type, ['success', 'warning', 'danger', 'info'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $type;
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--info";
        }

        if ($stretch) {
            $this->data['classList'][] = $this->getBaseClass() . "--stretch";
        }

        if( is_object($message) ) {
            $message = (array) $message;
        }

        $this->data['message'] = array_merge(['title' => null, 'message' => null], $message);
    }
}
