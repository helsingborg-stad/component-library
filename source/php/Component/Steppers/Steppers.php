<?php

namespace ComponentLibrary\Component\Steppers;

class Steppers extends \ComponentLibrary\Component\BaseController implements SteppersInterface
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Create padding modifier
        if($type) {
            $this->data['classList'][] = $this->getBaseClass() . "--type-" . $type;
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'steppers';
    }

    // -------------------------------------------------------------------------
    // SteppersInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlot(): string
    {
        return $this->data['slot'] ?? '';
    }

    public function getType(): string
    {
        return $this->data['type'] ?? 'dots';
    }
}
