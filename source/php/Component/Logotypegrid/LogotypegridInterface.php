<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Logotypegrid;

use ComponentLibrary\Component\ComponentInterface;

interface LogotypegridInterface extends ComponentInterface
{
    /**
     * A list of items, containing: src, alt, url(optional).
     */
    public function getItems(): array;

}
