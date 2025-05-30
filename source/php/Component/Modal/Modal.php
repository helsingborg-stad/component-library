<?php

namespace ComponentLibrary\Component\Modal;

class Modal extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Panel
        if ($isPanel) {
            $this->data['classList'][] = $this->getBaseClass() . "--is-panel";
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--is-modal";
        }

        if ($animation) {
            $this->data['classList'][] = $this->getBaseClass($animation, true);
        }

        //The size
        if ($size && in_array($size, ['sm', 'md', 'lg'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--size-" . $size;
        }

        //Padding
        if ($padding && in_array($padding, range(0, 4))) {
            $this->data['classList'][] = $this->getBaseClass() . "--padding-" . $padding;
        }

        //Border radius
        if ($borderRadius && in_array($borderRadius, ['sm', 'md', 'lg'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--border-radius-" . $borderRadius;
        }

        if (isset($ariaLabels)) {
            $this->data['ariaLabels'] = $ariaLabels;
        }

        if ($transparent) {
            $this->data['classList'][] = $this->getBaseClass() . "--transparent";
        }

        //Overlay
        $this->data['classList'][] = $this->getBaseClass() . "--overlay-" . $overlay;

        //Set dialog attributes
        $this->data['attributeList']['aria-modal'] = 'true';
        $this->data['attributeList']['role'] = 'dialog';
    }
}
