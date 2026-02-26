<?php

namespace ComponentLibrary\Component\Timeline;

/**
 * Class Timeline
 * @package ComponentLibrary\Component\Timeline
 */
class Timeline extends \ComponentLibrary\Component\BaseController implements TimelineInterface
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        if (isset($sequential) && $sequential) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . 'sequential';
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'timeline';
    }

    // -------------------------------------------------------------------------
    // TimelineInterface — generated getters
    // -------------------------------------------------------------------------

    public function getEvents(): array
    {
        return $this->data['events'] ?? [];
    }

    public function getSequential(): bool
    {
        return $this->data['sequential'] ?? false;
    }
}
