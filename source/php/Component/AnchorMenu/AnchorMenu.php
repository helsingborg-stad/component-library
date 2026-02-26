<?php

namespace ComponentLibrary\Component\AnchorMenu;

/**
 * Class AnchorMenu
 * @package ComponentLibrary\Component\AnchorMenu
 */
class AnchorMenu extends \ComponentLibrary\Component\BaseController implements AnchorMenuInterface  
{
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        $this->data['menuItems'] = $menuItems;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'anchorMenu';
    }

    // -------------------------------------------------------------------------
    // AnchorMenuInterface — generated getters
    // -------------------------------------------------------------------------

    public function getMenuItems(): array
    {
        return $this->data['menuItems'] ?? [];
    }
}
