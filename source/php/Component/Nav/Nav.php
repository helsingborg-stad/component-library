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
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add id if missing, prevents duploicate references
        if (empty($id)) {
            $this->data['id'] = $this->getUid();
        }

        //Add depth class
        $this->data['depth'] + 1;
        $this->data['classList'][] = $this->getBaseClass(
            "depth-" . ($this->data['depth'] + 1),
            true
        );

        //Add unlist class
        $this->data['classList'][] = "unlist";

        //Direction class for nav
        if ($direction) {
            $this->data['classList'][] = $this->getBaseClass($direction, true);
        }

        //Set default values to items array
        $this->data['items'] = $this->normalizeItems($items);

        //Set item attribute list
        $this->data['items'] = $this->itemAttributeList(
            $items, 
            $this->data
        );

        //Endpoint for async fetching
        if (isset($endpoint)) {
            $this->data['classList']['has-async'] = "true";
            $this->data['attributeList']['data-endpoint'] = $endpoint;
        }

        //Attributes
        $this->data['attributeList']['aria-orientation'] = $direction;
        $this->data['attributeList']['role'] = 'menu';

        //Attributes
        if ($direction == "horizontal") {
            $this->data['attributeList']['js-keep-in-viewport-after-resize'] = "1";
        }

        //Dropdown state
        if($this->hasDropDown($this->data)) {
            //Modifier
            $this->data['classList'][] = $this->getBaseClass('dropdown', true);
        }

        if (function_exists('get_theme_mod')) {
            $navAlignment = $this->getBaseClass() . '--' . get_theme_mod('header_alignment'); //NOT ALLOWED!
        }
    }

    /**
     * Check if there should be a dropdown
     * 
     * @param $data
     * 
     * @return bool
     */
    private function hasDropDown(array $data): bool 
    {
        extract($data);
        if($includeToggle && $direction == "horizontal") {
            return true; 
        }
        return false; 
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
            foreach ($items as $key => $item) {
                if (!isset($item['attributeList'])) {
                    $item['attributeList'] = [];
                }

                $items[$key] = $this->setRoleAttributes($item); 
                $items[$key] = $this->setToggleAttributes($item); 
            }
        }
        return $items;
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
     * Appen toggling attributes
     */
    private function setToggleAttributes(array $item): array
    {

        if (empty($item['children'])) {
            return $item; 
        }

        $item['attributeList'] = array_merge(
            $item['attributeList'],
            [
                'data-js-toggle-item' => $this->getUid(),
                'data-js-toggle-trigger' => $this->getUid(),
                'data-js-toggle-class' => "is-active"
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
        if (is_array($items) && !empty($items)) {
            foreach ($items as $key => $item) {
                $item = array_merge([
                    'id' => rand(1, PHP_INT_MAX),
                    'label' => "Unknown",
                    'ancestor' => false,
                    'active' => false,
                    'children' => false,
                    'href' => "#",
                    'class' => "",
                    'style' => "default",
                ], $item);

                //Recurse for children
                if (!empty($item['children']) && is_array($item['children'])) {
                    $item['children'] = $this->normalizeItems(
                        $item['children']
                    );
                }

                $items[$key] = $item;
            }
        }

        return $items;
    }
}
