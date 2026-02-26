<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Steppers;

use ComponentLibrary\Component\ComponentInterface;

interface SteppersInterface extends ComponentInterface
{
    /**
     * Steppers slot.
     */
    public function getSlot(): string;

    /**
     * Type of stepper, default is dots.
     */
    public function getType(): string;

}
