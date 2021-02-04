<?php

namespace ComponentLibrary\Component\Table;

class Table extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Zebra stripes
        if($hasZebraStripes) {
            $this->data['classList'][] = "table-striped";  
        }

        //Hover effect
        if($hasHoverEffect) {
            $this->data['classList'][] = "table-hover";  
        }

        //Border effect
        if($isBordered) {
            $this->data['classList'][] = "table-bordered";  
        }

        //Large table
        if($isLarge) {
            $this->data['classList'][] = "table-lg";  
        }

        //Smal table
        if($isSmall) {
            $this->data['classList'][] = "table-sm";  
        }

        if($filterable) {
            $this->data['attributeList']['js-table-filter'] = '';
        }

        if($sortable) {
            $this->data['attributeList']['js-table-sort'] = '';
        }

        if($pagination) {
            $this->data['attributeList']['js-table-pagination'] = $pagination;
            $this->data['attributeList']['js-table-pagination--current'] = 1;
        }
    }
}