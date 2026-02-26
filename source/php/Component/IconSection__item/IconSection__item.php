<?php

namespace ComponentLibrary\Component\IconSection__item;

class IconSection__item extends \ComponentLibrary\Component\BaseController implements IconSection__itemInterface
{
    public function init()
    {
        extract($this->data);
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'iconSection__item';
    }

    // -------------------------------------------------------------------------
    // IconSection__itemInterface — generated getters
    // -------------------------------------------------------------------------

    public function getIcon(): array
    {
        return $this->data['icon'] ?? null;
    }
}
