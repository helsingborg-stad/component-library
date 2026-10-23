<?php

namespace ComponentLibrary\Component\Chat__banner;

class Chat__banner extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass();
        $this->data['attributeList']['data-js-chat-banner'] = true;
    }
}
