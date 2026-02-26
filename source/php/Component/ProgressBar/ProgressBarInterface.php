<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\ProgressBar;

use ComponentLibrary\Component\ComponentInterface;

interface ProgressBarInterface extends ComponentInterface
{
    /**
     * IsCancelled.
     */
    public function getIsCancelled(): bool;

    /**
     * Value.
     */
    public function getValue(): int;

}
