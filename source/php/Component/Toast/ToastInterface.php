<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Toast;

use ComponentLibrary\Component\ComponentInterface;

interface ToastInterface extends ComponentInterface
{
    /**
     * Position of the toast: top-left, top-right, bottom-left, bottom-right.
     */
    public function getPosition(): string;

}
