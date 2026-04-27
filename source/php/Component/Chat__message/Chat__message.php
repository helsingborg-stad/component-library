<?php

namespace ComponentLibrary\Component\Chat__message;

class Chat__message extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass();
        $this->data['attributeList']['data-js-chat-message'] = true;
        $this->data['classList'][] = $this->getBaseClass() . '--' . ($isReply ? 'reply' : 'user');
    }
}