<?php

namespace ComponentLibrary\Component\Chat__info;

class Chat__info extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass();
    }
}
