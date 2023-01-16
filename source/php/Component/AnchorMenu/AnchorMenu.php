<?php

namespace ComponentLibrary\Component\AnchorMenu;

/**
 * Class AnchorMenu
 * @package ComponentLibrary\Component\AnchorMenu
 */
class AnchorMenu extends \ComponentLibrary\Component\BaseController  
{
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);
        var_dump($menuItems);
        $this->data['menuItems'] = $menuItems;
    }
}