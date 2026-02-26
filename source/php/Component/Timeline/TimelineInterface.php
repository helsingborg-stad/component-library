<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Timeline;

use ComponentLibrary\Component\ComponentInterface;

interface TimelineInterface extends ComponentInterface
{
    /**
     * An array of events.
     */
    public function getEvents(): array;

    /**
     * If true, the events will be displayed in a sequential order.
     */
    public function getSequential(): bool;

}
