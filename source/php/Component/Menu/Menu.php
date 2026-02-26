<?php

namespace ComponentLibrary\Component\Menu;

class Menu extends \ComponentLibrary\Component\BaseController implements MenuInterface  
{
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        //Horizontal menu
        if($isHorizontal) {
            $this->data['classList'][] = $this->getBaseClass() . "--horizontal"; 
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--vertical";
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'menu';
    }

    // -------------------------------------------------------------------------
    // MenuInterface — generated getters
    // -------------------------------------------------------------------------

    public function getActiveIndex(): bool
    {
        return $this->data['activeIndex'] ?? false;
    }

    public function getItems(): array
    {
        return $this->data['items'] ?? [];
    }

    public function getElementType(): string
    {
        return $this->data['elementType'] ?? 'nav';
    }

    public function getActiveClass(): string
    {
        return $this->data['activeClass'] ?? '--active';
    }

    public function getWrapper(): bool
    {
        return $this->data['wrapper'] ?? true;
    }

    public function getIsHorizontal(): bool
    {
        return $this->data['isHorizontal'] ?? false;
    }
}
