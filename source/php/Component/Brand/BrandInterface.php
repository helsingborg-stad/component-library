<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Brand;

use ComponentLibrary\Component\ComponentInterface;

interface BrandInterface extends ComponentInterface
{
    /**
     * Array containing specified logotype component attributes.
     */
    public function getLogotype(): array;

    /**
     * Array of brand name, each item will be separated on multiple lines.
     */
    public function getText(): array;

}
