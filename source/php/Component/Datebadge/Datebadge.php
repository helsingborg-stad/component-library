<?php

namespace ComponentLibrary\Component\Datebadge;

class Datebadge extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Sizes
        if (in_array($size, ['sm', 'md'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $size;
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--md";
        }

        //Format
        $date = strtotime($date);
        $this->data['month']    = date("M", $date);
        $this->data['day']      = date("d", $date);
    }
}
