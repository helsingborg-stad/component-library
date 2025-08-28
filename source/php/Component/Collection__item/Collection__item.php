<?php

namespace ComponentLibrary\Component\Collection__item;

use ComponentLibrary\Helper\ATagSanitizer;
use ComponentLibrary\Helper\TagSanitizer;

class Collection__item extends \ComponentLibrary\Component\BaseController  
{
    private array $slotMapping = [
        'before'   => 'beforeSlotHasData',
        'floating' => 'floatingSlotHasData',
        'slot'     => 'slotHasData'
    ];

    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (!empty($bordered)) {
            $this->data['classList'][] = $this->getBaseClass('bordered', true);
        }

        $this->data['tagSanitizer'] = new TagSanitizer();

        $this->data['icon'] = $this->getIcon($icon);

        // Icon position
        if ($this->data['icon'] && $iconLast) {
            $this->data['classList'][] = $this->getBaseClass('icon-last', true);
        }

        //Link handling
        if($link) {
            $this->data['componentElement'] = "a"; 
            $this->data['action'] = false; 
            $this->data['classList'][] = $this->getBaseClass() . '--action';
            $this->data['attributeList']['href'] = $link; 
		} else {
            $this->data['componentElement'] = "div"; 
        }

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
            if ($this->data[$hasDataKey] && $this->data['componentElement'] === 'a') {
                $this->data[$slot] = $this->tagSanitizer->removeATags((string) $this->data[$slot]);
            }
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