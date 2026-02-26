<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Paper;

use ComponentLibrary\Component\ComponentInterface;

interface PaperInterface extends ComponentInterface
{
    /**
     * Paper content.
     */
    public function getSlot(): string;

    /**
     * Numeric value of padding sizes. Se padding doc for more info.
     */
    public function getPadding(): bool;

    /**
     * Transparent paper with no shadow.
     */
    public function getTransparent(): bool;

}
