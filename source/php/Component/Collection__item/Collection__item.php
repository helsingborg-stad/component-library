<?php

namespace ComponentLibrary\Component\Collection__item;

use ComponentLibrary\Helper\ATagSanitizer;
use ComponentLibrary\Helper\TagSanitizer;

class Collection__item extends \ComponentLibrary\Component\BaseController implements Collection__itemInterface  
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

        $this->data['icon'] = $this->buildIcon($icon);

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

    private function buildIcon(array|string|false $icon): array|false
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'collection__item';
    }

    // -------------------------------------------------------------------------
    // Collection__itemInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getPrefix(): string
    {
        return $this->data['prefix'] ?? '';
    }

    public function getIcon(): bool
    {
        return $this->data['icon'] ?? false;
    }

    public function getIconLast(): bool
    {
        return $this->data['iconLast'] ?? false;
    }

    public function getAction(): bool
    {
        return $this->data['action'] ?? false;
    }

    public function getSecondary(): string
    {
        return $this->data['secondary'] ?? '';
    }

    public function getLink(): string
    {
        return $this->data['link'] ?? '';
    }

    public function getBordered(): bool
    {
        return $this->data['bordered'] ?? false;
    }
}
