<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\AnchorMenu;

use ComponentLibrary\Component\ComponentInterface;

interface AnchorMenuInterface extends ComponentInterface
{
    /**
     * An array containing arrays of items. An item should contain a label, anchor and if wanted an icon as well.
     */
    public function getMenuItems(): array;

}
