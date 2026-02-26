<?php

namespace ComponentLibrary\Component\MegaMenu;

class MegaMenu extends \ComponentLibrary\Component\BaseController implements MegaMenuInterface  
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

            if ($menuItem['active'] ?? false) {
                $menuItem['classList'][] = 'is-current';
            }

            if (isset($menuItem['children']) && is_array($menuItem['children']) && !empty($menuItem['children'])) {
                $menuItem['classList'][] = $this->getBaseClass() . '__item--has-children';
                $menuItem['children'] = $this->generateMenuItems($menuItem['children']);
            }
            
            $menuItem['classNames'] = trim(implode(' ', $menuItem['classList']));
            $result[$key] = $menuItem;
        }

        return $result;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'megaMenu';
    }

    // -------------------------------------------------------------------------
    // MegaMenuInterface — generated getters
    // -------------------------------------------------------------------------

    public function getMenuItems(): array
    {
        return $this->data['menuItems'] ?? [];
    }

    public function getParentType(): string
    {
        return $this->data['parentType'] ?? 'default';
    }

    public function getParentStyle(): string|bool
    {
        return $this->data['parentStyle'] ?? false;
    }

    public function getParentStyleColor(): string
    {
        return $this->data['parentStyleColor'] ?? 'primary';
    }

    public function getChildType(): string
    {
        return $this->data['childType'] ?? 'default';
    }

    public function getChildStyle(): string|bool
    {
        return $this->data['childStyle'] ?? false;
    }

    public function getChildStyleColor(): string
    {
        return $this->data['childStyleColor'] ?? 'primary';
    }

    public function getMobile(): bool
    {
        return $this->data['mobile'] ?? false;
    }
}
