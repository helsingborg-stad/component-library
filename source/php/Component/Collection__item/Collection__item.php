<?php

namespace ComponentLibrary\Component\Collection__item;

class Collection__item extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['beforeSlotHasData']   = $this->slotHasData('before');
        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');
        $this->data['slotHasData']         = $this->slotHasData('slot');

        if ($this->data['slotHasData']) {
            $this->data['slot'] = $this->tagSanitizer->removeATags((string) $this->data['slot']);
        }

        if ($this->data['beforeSlotHasData']) {
            $this->data['before'] = $this->tagSanitizer->removeATags((string) $this->data['before']);
        }

        if ($this->data['floatingSlotHasData']) {
            $this->data['floating'] = $this->tagSanitizer->removeATags((string) $this->data['floating']);
        }

        if (!empty($bordered)) {
            $this->data['classList'][] = $this->getBaseClass('bordered', true);
        }

        $this->data['icon'] = $this->getIcon($icon);

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

    private function getIcon(array|string|false $icon): array|false
    {
        if (empty($icon)) {
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