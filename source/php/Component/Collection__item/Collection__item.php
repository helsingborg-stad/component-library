<?php

namespace ComponentLibrary\Component\Collection__item;

class Collection__item extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['beforeSlotHasData']   = $this->slotHasData('before');
        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');

        if (!empty($displayIcon)) {
            $this->data['classList'][] = $this->getBaseClass('show-icon', true);
        }

        if (!empty($bordered)) {
            $this->data['classList'][] = $this->getBaseClass('bordered', true);
        }

        $this->data['icon'] = $this->getIcon($icon, $displayIcon);

        //Link handling
        if($link) {
            $this->data['componentElement'] = "a"; 
            $this->data['action'] = false; 
            $this->data['classList'][] = $this->getBaseClass() . '--action';
            $this->data['attributeList']['href'] = $link; 
		} else {
            $this->data['componentElement'] = "div"; 
        }
    }

    private function getIcon(array|string|false $icon, bool $displayIcon): array|false
    {
        if (!$displayIcon || !$icon) {
            return false;
        } elseif (is_array($icon)) {
            return $icon;
        } else {
            return [
                'icon' => $icon, 
                'size' => 'md',
                'decorative' => true
            ];
        }
    }
}