<?php

namespace ComponentLibrary\Component\Element;

/**
 * Class Element
 * @package ComponentLibrary\Component\Element
 */
class Element extends \ComponentLibrary\Component\BaseController implements ElementInterface
{
    public function init()
    {
        $this->data['slotHasData'] = $this->slotHasData('slot');

        if ($this->data['slotHasData'] && $this->data['componentElement'] === 'a') {
            $this->data['slot'] = $this->tagSanitizer->removeATags((string) $this->data['slot']);
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'element';
    }

    // -------------------------------------------------------------------------
    // ElementInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getHideIfNoContent(): bool
    {
        return $this->data['hideIfNoContent'] ?? true;
    }
}
