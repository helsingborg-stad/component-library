<?php

namespace ComponentLibrary\Component\Header;

class Header extends \ComponentLibrary\Component\BaseController implements HeaderInterface  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData'] = $this->slotHasData('slot');

        if ($backgroundColor) {
            $this->data['classList'][] = "{$this->getBaseClass()}--{$backgroundColor}";
        }

        if ($textColor) {
            $this->data['classList'][] = "{$this->getBaseClass()}--text-{$textColor}";
        }

        if ($sticky) {
            $this->data['classList'][] = "{$this->getBaseClass()}--sticky";
        }

    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'header';
    }

    // -------------------------------------------------------------------------
    // HeaderInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'header';
    }

    public function getId(): mixed
    {
        return $this->data['id'] ?? null;
    }

    public function getTextColor(): bool
    {
        return $this->data['textColor'] ?? false;
    }

    public function getBackgroundColor(): bool
    {
        return $this->data['backgroundColor'] ?? false;
    }

    public function getSticky(): bool
    {
        return $this->data['sticky'] ?? false;
    }
}
