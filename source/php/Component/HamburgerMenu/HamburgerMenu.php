<?php

namespace ComponentLibrary\Component\HamburgerMenu;

class HamburgerMenu extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        if($menuItems) {
            $this->data['menuItems'] = $this->generateMenuItems($menuItems);
        }
    }

    public function generateMenuItems(array $menuItems = []) {
        $result = [];
        foreach($menuItems as $key => $menuItem) {
            $menuItem['classList'] = $menuItem['classList'] ?? [];

            if($menuItem['active']) {
                $menuItem['classList'][] = 'is-current';
            }

            if($menuItem['children']) {
                $menuItem['classList'][] = $this->getBaseClass() . '__item--has-children';
                $menuItem['children'] = $this->generateMenuItems($menuItem['children']);
            }
            
            $menuItem['classNames'] = trim(implode(' ', $menuItem['classList']));
            $result[$key] = $menuItem;
        }

        return $result;
    }
}