<?php

namespace ComponentLibrary\Component\Table__cell;

class Table__cell extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['componentElement'] = in_array($componentElement ?? null, ['td', 'th'], true)
            ? $componentElement
            : 'td';

        $this->data['attributeList']['scope'] = 'cell';

        $this->data['classList'][]  = $this->getBaseClass();

        if ($index !== null) {
            $this->data['classList'][]  = $this->getBaseClass() . '--column-' . $index;
            $this->data['attributeList']['data-js-row-index'] = $index;
        }

    }
}