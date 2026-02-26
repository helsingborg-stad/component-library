<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\IconSection;

use ComponentLibrary\Component\ComponentInterface;

interface IconSectionInterface extends ComponentInterface
{
    /**
     * The gap between the items in the icon section. Number between 0-12.
     */
    public function getGap(): mixed;

}
