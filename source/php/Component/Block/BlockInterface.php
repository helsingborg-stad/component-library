<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Block;

use ComponentLibrary\Component\ComponentInterface;

interface BlockInterface extends ComponentInterface
{
    /**
     * The heading of the block.
     */
    public function getHeading(): string;

    /**
     * Short text to describe target content.
     */
    public function getContent(): string|array;

    /**
     * String or array of strings containing the meta information.
     */
    public function getMeta(): string|array;

    /**
     * String or array of strings containing the secondary meta information.
     */
    public function getSecondaryMeta(): string|array;

    /**
     * Array of image attributes, src, alt, backgroudColor.
     */
    public function getImage(): mixed;

    /**
     * Simple href link.
     */
    public function getLink(): string;

    /**
     * Ratio of the block.
     */
    public function getRatio(): string;

    /**
     * Preformatted date.
     */
    public function getDate(): array;

    /**
     * Display date as a badge.
     */
    public function getDateBadge(): bool;

    /**
     * An array with the same specification as the icon component.
     */
    public function getIcon(): bool|array;

    /**
     * IconBackgroundColor.
     */
    public function getIconBackgroundColor(): string;

}
