<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Modal;

use ComponentLibrary\Component\ComponentInterface;

interface ModalInterface extends ComponentInterface
{
    /**
     * The title of the modal.
     */
    public function getHeading(): string;

    /**
     * The main content of the modal.
     */
    public function getSlot(): string;

    /**
     * Extra slot at the bottom of the modal (below content).
     */
    public function getBottom(): string;

    /**
     * Overlay.
     */
    public function getOverlay(): string;

    /**
     * Removes padding, to enable a panel like behaviour. Cover whole page viewport.
     */
    public function getIsPanel(): bool;

    /**
     * A unique id which will be used to target the modal to open with the correct data-attr.
     */
    public function getId(): string;

    /**
     * Available animations: slide-up, slide-down, slide-left, slide-right.
     */
    public function getAnimation(): string;

    /**
     * Adds navigation arrows, to slide between stuff.
     */
    public function getNavigation(): bool;

    /**
     * Empty as default is set to max width 800px. But you can use sm, md and lg.
     */
    public function getSize(): string;

    /**
     * Adds whitespace around the content. Value: 1 - 4.
     */
    public function getPadding(): int;

    /**
     * Rounded edges. Value: sm, md, lg.
     */
    public function getBorderRadius(): bool;

    /**
     * Transparent wrapper around the content.
     */
    public function getTransparent(): bool;

    /**
     * Text for the close button. Default is empty.
     */
    public function getCloseButtonText(): string;

}
