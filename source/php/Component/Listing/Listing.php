<?php

namespace ComponentLibrary\Component\Listing;

class Listing extends \ComponentLibrary\Component\BaseController implements ListingInterface  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (!empty($padding)) {
            $this->data['classList'][] = $this->getBaseClass('padding' . '-' . $padding, true);
        } 
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'listing';
    }

    // -------------------------------------------------------------------------
    // ListingInterface — generated getters
    // -------------------------------------------------------------------------

    public function getList(): array
    {
        return $this->data['list'] ?? [];
    }

    public function getElementType(): string
    {
        return $this->data['elementType'] ?? 'ul';
    }

    public function getIcon(): bool
    {
        return $this->data['icon'] ?? true;
    }

    public function getPadding(): bool
    {
        return $this->data['padding'] ?? false;
    }
}
