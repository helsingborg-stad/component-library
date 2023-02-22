<?php

namespace ComponentLibrary\Component\Nav;

use SubItem; 

/**
 * Class Nav
 *
 * The Nav class is responsible for generating the navigation component.
 *
 * @package ComponentLibrary\Component\Nav
 */
class Nav extends \ComponentLibrary\Component\BaseController
{

    /**
     * Initializes the Nav component with data.
     *
     * @return void
     */
    public function init()
    {
        //Declarations
        if(!isset($this->data['depth'])) {
            $this->data['depth'] = 1;  
        }

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add id if missing, prevents duploicate references
        if (empty($id)) {
            $this->data['id'] = $this->getUid();
        }

        //Classes
        $this->data['classList'][] = $this->getBaseClass(
            "depth-" . $this->data['depth'],
            true
        );
        $this->data['classList'][] = "unlist";
        $this->data['classList'][] = $this->getBaseClass($direction, true);

        //Set default values to items array
        $this->data['items'] = $items = $this->normalizeItems($items);

        //Set item attribute list
        $this->data['items'] = $this->itemAttributeList(
            $items, 
            $this->data
        );

        //Endpoint for async fetching
        if (isset($endpoint)) {
            $this->data['classList'][] = "has-async";
            $this->data['attributeList']['data-endpoint'] = $endpoint;
        }

        //General Attributes
        $this->data['attributeList']['aria-orientation'] = $direction;
        $this->data['attributeList']['role'] = 'menu';
        $this->data['attributeList']['js-keep-in-viewport-after-resize'] = "1";

        //Children (view func)
        $this->data['hasChildren'] = function($children) {
            !empty($children);
        };

        //Create item class (view func)
        $this->data['itemClass'] = function($item) {
            $classList = $item['classList']; 

            //Base class list
            $classList[] = $this->getBaseClass('item'); 
            $classList[] = $this->getBaseClass('item') . '--' . $item['style'];
            $classList[] = $this->getBaseClass('item') . '--depth-' . $this->data['depth'];

            //Active state
            if($item['active']) {
                $classList[] = "is-current"; 
            }

            //Open state
            if($item['active'] && $item['children'] || $item['ancestor']) {
                $classList[] = "is-open";
            }

            //If has fetched
            if(is_array($item['children'])) {
                $classList[] = "has-fetched"; 
            }

            //Has children
            if(!empty($item['children'])) {
                $classList[] = "has-children";
            }

            //If item has a toggle
            if(!empty($item['children']) && $this->data['includeToggle'] && $item['style'] == 'default') {
                $classList[] = "has-toggle"; 
            }

            return implode(" ", $classList); 
        };
    }

    /**
     * Set item attribute list.
     *
     * @param array $items An array of navigation items.
     * @param array $data  An array of data.
     *
     * @return array An array of normalized navigation items.
     */
    public function itemAttributeList($items, $data)
    {
        if (is_array($items) && !empty($items)) {
            foreach ($items as $key => &$item) {

                if (!isset($item['attributeList'])) {
                    $item['attributeList'] = [];
                }

                $item = $this->setRoleAttributes($item); 
                $item = $this->setAriaLabelAttributes($item);
            }

        }

        return $items;
    }

    /**
     * Append aria-label attribute
     */
    private function setAriaLabelAttributes($item) {
        $item['attributeList'] = array_merge(
            $item['attributeList'],
            [
                'aria-label' => $item['label'] ?? ''
            ]
            );

        return $item;
    }

    /**
     * Append the correct role attributes
     */
    private function setRoleAttributes(array $item): array
    {
        $item['attributeList'] = array_merge(
            $item['attributeList'],
            [
                'role' => 'menuitem'
            ]
        );

        return $item;
    }

    /**
     * Normalizes the navigation items.
     *
     * @param array $items An array of navigation items.
     *
     * @return array An array of normalized navigation items.
     */
    public function normalizeItems(array $items): array
    {
        if(is_countable($items)) {
            foreach ($items as $key => &$item) {
                $item = array_merge([
                    'id' => rand(1, PHP_INT_MAX),
                    'label' => "Unknown",
                    'ancestor' => false,
                    'active' => false,
                    'children' => false,
                    'href' => "#",
                    'classList' => [],
                    'style' => "default",
                    'icon' => []
                ], $item);

                //Recurse for children
                if (is_countable($item['children'])) {
                    $item['children'] = $this->normalizeItems(
                        $item['children']
                    );
                }
            }
        }

        return $items;
    }
}
