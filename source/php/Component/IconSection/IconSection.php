<?php

namespace ComponentLibrary\Component\IconSection;

class IconSection extends \ComponentLibrary\Component\BaseController implements IconSectionInterface
{
    public function init()
    {
        extract($this->data);

        $this->data['classList'][] =  $this->getBaseClass('gap-' . $gap, true);
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'iconSection';
    }

    // -------------------------------------------------------------------------
    // IconSectionInterface — generated getters
    // -------------------------------------------------------------------------

    public function getGap(): mixed
    {
        return $this->data['gap'] ?? 0;
    }
}
