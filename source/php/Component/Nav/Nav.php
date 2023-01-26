<?php

namespace ComponentLibrary\Component\Nav;

use SubItem; 

class Nav extends \ComponentLibrary\Component\BaseController
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add id if missing, prevents duploicate references
        if (empty($id)) {
            $this->data['id'] = $this->getUid();
        }

        //Add depth class
        $this->data['depth'] + 1;
        $this->data['classList'][] = $this->getBaseClass() . "--depth-" . $this->data['depth'];

        //Set default values to items array
        $this->data['items'] = $this->fillItemsData($items);

        //Set item attribute list
        $this->data['items'] = $this->itemAttributeList($items, $this->data);

        //Endpoint for async fetching
        if (isset($endpoint)) {
            $this->data['attributeList']['data-endpoint'] = $endpoint;
        }

        //Add unlist class
        $this->data['classList'][] = "unlist";

        //Direction of nav
        if ($direction) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $direction;
        }

        //Attributes
        $this->data['attributeList']['aria-orientation'] = $direction;
        $this->data['attributeList']['role'] = 'menu';

        //Attributes
        if ($direction == "horizontal") {
            $this->data['attributeList']['js-keep-in-viewport-after-resize'] = "1";
        }

        if (function_exists('get_theme_mod')) {
            $navAlignment = $this->getBaseClass() . '--' . get_theme_mod('header_alignment');
        }
    }

    public function itemAttributeList($items, $data)
    {
        if (is_array($items) && !empty($items)) {
            foreach ($items as $key => $item) {
                if (!isset($item['attributeList'])) {
                    $item['attributeList'] = [];
                }

                $items[$key]['attributeList'] = array_merge(
                    $item['attributeList'],
                    [
                        'role' => 'menuitem'
                    ]
                );
            }
        }
        return $items;
    }

    public function fillItemsData($items)
    {
        if (is_array($items) && !empty($items)) {
            foreach ($items as $key => $item) {
                //Add defaults
                $item = array_merge([
                    'ID' => rand(1, PHP_INT_MAX),
                    'label' => "Unknown",
                    'ancestor' => false,
                    'active' => false,
                    'children' => false,
                    'href' => "#",
                    'class' => "",
                    'style' => "default",
                ], $item);

                //Do above, for children
                if (is_array($item['children'])) {
                    $item['children'] = $this->fillItemsData($item['children']);
                }

                $items[$key] = $item;
            }
        }

        return $items;
    }
}
