<?php

namespace ComponentLibrary\Component\Accordion;

/**
 * Class Accordion
 * @package ComponentLibrary\Component\Accordion
 */
class Accordion extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData']         = $this->slotHasData('slot');

        if ($spacedSections) {
            $this->data['classList'] = ['c-accordion--spaced-sections'];
        }

        $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
    }
}
