<?php

namespace ComponentLibrary\Component\Table__row;

class Table__row extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        $this->data['attributeList']['scope'] = 'row';
        $this->data['attributeList']['data-js-table-row'] = true;
        $this->data['classList'][] = $this->getBaseClass();

        if ($index !== null) {
            $this->data['classList'][] = $this->getBaseClass() . '-' . $index;
            $this->data['attributeList']['data-js-row-index'] = $index;
        }

    }
}