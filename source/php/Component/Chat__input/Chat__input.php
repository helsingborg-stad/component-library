<?php

namespace ComponentLibrary\Component\Chat__input;

class Chat__input extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass();
        $this->data['attributeList']['data-js-chat-input'] = true;
    }
}