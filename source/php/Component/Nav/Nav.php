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

        //Height modifiers
        if($height) {
            $this->data['classList'][] = $this->getBaseClass("height-" . $height, true);
        }

        //Add id if missing, prevents duplicated references
        if (empty($id) || $this->data['depth'] > 1) {
            $this->data['id'] = $this->getUid();
        }

        if ($compressed) {
            $this->data['classList'][] = $this->getBaseClass('compressed', true);
        }

        //Classes
        $this->data['classList'][] = $this->getBaseClass(
            "depth-" . $this->data['depth'],
            true
        );
        $this->data['classList'][] = "unlist";
        $this->data['classList'][] = $this->getBaseClass($direction, true);

        //Set default values to items array
        if(is_array($items)) {
            $this->data['items'] = $items = $this->normalizeItems($items);
        }

        if (!empty($isExtendedDropdown)) {
            $this->data['classList'][] = $this->getBaseClass('extended-dropdown', true);
        }
        
        //Set item attribute list
        $this->data['items'] = $this->itemAttributeList(
            $items, 
            $this->data
        );

        //General Attributes
        $this->data['attributeList']['aria-orientation'] = $direction;
        $this->data['attributeList']['role'] = 'menu';
        $this->data['attributeList']['data-js-keep-in-viewport-after-resize'] = "1";

        //Get Expand label
        $this->data['getExpandLabel'] = function ($itemLable, $expandLabel) {
            if(!empty($itemLable)) {
                return $expandLabel . ": ". $itemLable;
            }
            return $expandLabel;
        }; 

        //Create item class (view func)
        $this->data['itemClass'] = function($item, $direction) {
            $classList = $item['classList'];

            //Base class list
            $classList[] = $this->getBaseClass('item'); 
            $classList[] = $this->getBaseClass('item') . '--' . $item['style'];
            $classList[] = $this->getBaseClass('item') . '--depth-' . $this->data['depth'];

            //Active state
            if($item['active']) {
                $classList[] = "is-current";

                if ($direction === 'vertical') {
                    $classList[] = "is-open";
                }
            }

            if($this->isAncestor($item['ancestor'])) {
                $classList[] = "is-ancestor"; 
            }

            //Open state
            $openState = [
                $item['active'], 
                $item['hasChildren'], 
                $item['ancestor'],
                $direction
            ];

            if($this->isOpen(...$openState)) {
                $classList[] = "is-open";
            }

            //If has fetched
            if(is_array($item['children'])) {
                $classList[] = "has-fetched"; 
            }

            //Has children
            if($item['hasToggle']) {
                $classList[] = "has-children";
            }

            //If item has a toggle
            if($item['hasToggle']) {
                $classList[] = "has-toggle"; 
            }

            //If item has async method
            if($this->hasAsyncUrl($item)) {
                $classList[] = "has-async"; 
                $classList[] = "js-async-children-data";
            }

            return implode(" ", $classList); 
        };

        //Indent 
        if($indentSubLevels === true) {
            $this->data['classList'][] = $this->getBaseClass('indent-sublevels', true);
        }
    }

    private function isOpen($isActive, $hasChildren, $isAncestor, $direction) {
        if($isActive && $hasChildren && $direction == 'vertical') {
            return true; 
        }

        if($isAncestor && $direction == 'vertical') {
            return true; 
        }

        return false; 
    }

    private function isAncestor($ancestor) {
        return (bool) $ancestor;
    }
    
    /**
     * Determines whether a navigation item has children.
     *
     * Returns true for non-empty arrays or boolean true (which signals async
     * child-loading intent regardless of whether async metadata is present).
     *
     * @param mixed $children The children value of the item.
     *
     * @return bool
     */
    private function hasChildren(mixed $children): bool
    {
        if (is_array($children) && !empty($children)) {
            return true;
        }

        if ($children === true) {
            return true;
        }

        return false;
    }

    /**
     * Determines whether a navigation item should render an expand toggle.
     *
     * The toggle is shown when:
     *  - includeToggle is enabled, AND
     *  - children is a non-empty array (concrete children), OR
     *  - children is boolean true AND the item carries async-fetch metadata
     *    (e.g. data-fetch-url).
     *
     * When children is true but no async metadata is present the toggle is
     * suppressed to avoid misleading UI.
     *
     * @param mixed $children The children value of the item.
     * @param array $item     The full item array used to inspect async metadata.
     *
     * @return bool
     */
    private function hasToggle(mixed $children, array $item = []): bool
    {
        if (!$this->data['includeToggle']) {
            return false;
        }

        if (is_array($children) && !empty($children)) {
            return true;
        }

        if ($children === true) {
            return $this->hasAsyncUrl($item);
        }

        return false;
    }

    private function hasAsyncUrl($item) {
        if(isset($item['attributeList']) && is_array($item['attributeList'])) {
            if(array_key_exists('data-fetch-url', $item['attributeList'])) {
                return !empty($item['attributeList']['data-fetch-url']); 
            }
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
            foreach ($items as $key => &$item) {

                if (!isset($item['attributeList'])) {
                    $item['attributeList'] = [];
                }

                $item = $this->setRoleAttributes($item); 
                $item = $this->setDepthAttributes($item);
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
     * Append depth attribute
     */
    private function setDepthAttributes($item) {
        $item['attributeList'] = array_merge(
            $item['attributeList'],
            [
                'data-depth' => $this->data['depth']
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
                    'icon' => [],
                ], $item);

                $item['hasToggle']      = $this->hasToggle($item['children'], $item);
                $item['hasChildren']    = $this->hasChildren($item['children'], $item);

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
