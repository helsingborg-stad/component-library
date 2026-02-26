<?php

namespace ComponentLibrary\Component\Notification;

class Notification extends \ComponentLibrary\Component\BaseController implements NotificationInterface  
{
    
    public function init() {

        //Extract array for easy access (fetch only)
        extract($this->data);
        $this->data['classList'][] = $this->getBaseClass() . '__spawn--' . $animation['direction'];
        if(!$animation['onPageLoad']) $this->data['classList'][] = 'u-display--none';
        if($autoHideDuration) $this->data['attributeList']['autoHideDuration'] = $autoHideDuration;
        if($maxAmount) $this->data['attributeList']['maxAmount'] = $maxAmount;
        $this->data['attributeList']['direction'] = $animation['direction'];
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'notification';
    }

    // -------------------------------------------------------------------------
    // NotificationInterface — generated getters
    // -------------------------------------------------------------------------

    public function getElement(): string
    {
        return $this->data['element'] ?? 'div';
    }

    public function getSlot(): string
    {
        return $this->data['slot'] ?? '';
    }

    public function getMessage(): array
    {
        return $this->data['message'] ?? [];
    }

    public function getType(): mixed
    {
        return $this->data['type'] ?? null;
    }

    public function getIcon(): array
    {
        return $this->data['icon'] ?? [];
    }

    public function getAnimation(): object
    {
        return $this->data['animation'] ?? (object) [];
    }
}
