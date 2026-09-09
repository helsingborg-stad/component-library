<?php

namespace ComponentLibrary\Component\Table__body;

class Table__body extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        $this->data['attributeList']['data-js-table-body'] = true;
    }
}