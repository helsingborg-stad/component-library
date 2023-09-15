<?php

namespace ComponentLibrary\Component\MegaMenu;

class MegaMenu extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['classList'][] = 'u-display--none';
        
        if($menuItems) {
            $this->data['menuItems'] = $this->generateMenuItems($menuItems);
        }

        if(!$mobile) {
            $this->data['classList'][] = 'u-display--none@xs';
            $this->data['classList'][] = 'u-display--none@sm';
            $this->data['classList'][] = 'u-display--none@md';
        }
    }

    public function generateMenuItems(array $menuItems = []) {
        $result = [];
        foreach($menuItems as $key => $menuItem) {
            $menuItem['classList'] = $menuItem['classList'] ?? [];

            if($menuItem['active'] ?? false) {
                $menuItem['classList'][] = 'is-current';
            }

            if($menuItem['children'] ?? false && is_array($menuItem['children']) && !empty($menuItem['children'])) {
                $menuItem['classList'][] = $this->getBaseClass() . '__item--has-children';
                $menuItem['children'] = $this->generateMenuItems($menuItem['children']);
            }
            
            $menuItem['classNames'] = trim(implode(' ', $menuItem['classList']));
            $result[$key] = $menuItem;
        }

        return $result;
    }
}