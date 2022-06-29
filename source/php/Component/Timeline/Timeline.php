<?php

namespace ComponentLibrary\Component\Timeline;

/**
 * Class Timeline
 * @package ComponentLibrary\Component\Timeline
 */
class Timeline extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);
    }
}
