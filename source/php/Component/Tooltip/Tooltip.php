<?php

namespace ComponentLibrary\Component\Tooltip;

class Tooltip extends \ComponentLibrary\Component\BaseController implements TooltipInterface
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData'] = $this->slotHasData('slot');

        //Add classes
        $this->data['classList'][] = $this->getBaseClass() . '--'. $placement; 
        $this->data['classList'][] = $this->getBaseClass() . '--hidden'; 

        $this->data['attributeList']['original-placement'] = $this->getBaseClass() . '--' . $placement; 

        $this->data['id'] = $this->getUid();
        
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'tooltip';
    }

    // -------------------------------------------------------------------------
    // TooltipInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getTypographyElement(): string
    {
        return $this->data['typographyElement'] ?? 'strong';
    }

    public function getPlacement(): string
    {
        return $this->data['placement'] ?? 'bottom';
    }

    public function getIcon(): string
    {
        return $this->data['icon'] ?? 'info';
    }

    public function getIconSize(): string
    {
        return $this->data['iconSize'] ?? 'md';
    }

    public function getLabel(): bool
    {
        return $this->data['label'] ?? false;
    }
}
