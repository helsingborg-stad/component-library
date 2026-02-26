<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tooltip;

use ComponentLibrary\Component\ComponentInterface;

interface TooltipInterface extends ComponentInterface
{
    /**
     * What element to wrap this component with.
     */
    public function getComponentElement(): string;

    /**
     * What element to wrap the label with.
     */
    public function getTypographyElement(): string;

    /**
     * Selects the placement of the tooltip.
     */
    public function getPlacement(): string;

    /**
     * Name of the icon, alternatively false.
     */
    public function getIcon(): string;

    /**
     * Size of the icon.
     */
    public function getIconSize(): string;

    /**
     * Label of the tooltip, alternatively false.
     */
    public function getLabel(): bool;

}
