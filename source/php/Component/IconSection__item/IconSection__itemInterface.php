<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\IconSection__item;

use ComponentLibrary\Component\ComponentInterface;

interface IconSection__itemInterface extends ComponentInterface
{
    /**
     * An array with the same specification as the icon component.
     */
    public function getIcon(): array;

}
