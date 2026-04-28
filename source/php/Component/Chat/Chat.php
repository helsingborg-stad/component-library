<?php

namespace ComponentLibrary\Component\Chat;

class Chat extends \ComponentLibrary\Component\BaseController  
{
    private array $slotMapping = [
        'titleArea' => 'titleAreaSlotHasContent',
    ];
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);
        $this->data['attributeList']['data-js-chat'] = $this->data['id'] ?? uniqid('chat-');

        if ($persistent && $this->data['id'] !== null) {
            $this->data['attributeList']['data-js-chat-persistent'] = true;
        }

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
        }
    }
}