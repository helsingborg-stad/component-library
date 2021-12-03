<?php

namespace ComponentLibrary\Component\Notice;

class Notice extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        if (in_array($this->data['type'], ['success', 'warning', 'danger', 'info'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $this->data['type'];
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--info";
        }
    }
}
