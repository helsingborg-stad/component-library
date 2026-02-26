<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Fab;

use ComponentLibrary\Component\ComponentInterface;

interface FabInterface extends ComponentInterface
{
    /**
     * Where on the screen the FAB should be positioned.
     */
    public function getPosition(): string;

    /**
     * Heading text for panel.
     */
    public function getHeading(): string;

    /**
     * Settings for the button element (trigger).
     */
    public function getButton(): bool;

    /**
     * Contents of popup panel.
     */
    public function getSlot(): string;

    /**
     * The label to indicate closing action.
     */
    public function getCloseLabel(): bool;

    /**
     * The icon to indicate closing action.
     */
    public function getCloseIcon(): bool;

}
