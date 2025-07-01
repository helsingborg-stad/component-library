<?php

namespace ComponentLibrary\Component\Element;

/**
 * Class Element
 * @package ComponentLibrary\Component\Element
 */
class Element extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        $this->data['slotHasData'] = $this->slotHasData('slot');
    }
}
