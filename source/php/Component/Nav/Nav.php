<?php

namespace ComponentLibrary\Component\Nav;

use SubItem; 

class Nav extends \ComponentLibrary\Component\BaseController
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add depth class
        $this->data['depth'] + 1;  
        $this->data['classList'][] = $this->getBaseClass() . "--depth-" . $this->data['depth'];

        //Set default values to items array
        $this->data['items'] = $this->fillItemsData($items);

        //Endpoint for async fetching
        if(isset($endpoint)) {
            $this->data['attributeList']['data-endpoint'] = $endpoint; 
        }

        //Add unlist class
        $this->data['classList'][] = "unlist"; 

        //Direction of nav
        if($direction) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $direction; 
        }

        //Attributes
        $this->data['attributeList']['aria-orientation'] = $direction; 

        //Attributes
        if ($direction == "horizontal") {
            $this->data['attributeList']['js-resize-by-children'] = "1";
            $this->data['attributeList']['js-keep-in-viewport-after-resize'] = "1";
        }
    }

    public function fillItemsData($items)
    {
        if(is_array($items) && !empty($items)) {
            foreach ($items as $key => $item) {
                !isset($item['ancestor']) ? $item['ancestor'] = false : "";
                !isset($item['active']) ? $item['active'] = false : "";
                !isset($item['children']) ? $item['children'] = false : "";
                !isset($item['id']) ? $item['id'] = $item['label'] : "";

                if(is_array($item['children'])) {
                    $item['children'] = $this->fillItemsData($item['children']);
                }

                $items[$key] = $item;
            }
        }

        return $items;
    }
}
