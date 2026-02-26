<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Box;

use ComponentLibrary\Component\ComponentInterface;

interface BoxInterface extends ComponentInterface
{
    /**
     * The heading of the block.
     */
    public function getHeading(): string;

    /**
     * Short text to describe target content.
     */
    public function getContent(): string;

    /**
     * String or array of strings containing the meta information.
     */
    public function getMeta(): string|array;

    /**
     * String or array of strings containing the secondary meta information.
     */
    public function getSecondaryMeta(): string|array;

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
    public function getDate(): string;

    /**
     * Display date as a badge.
     */
    public function getDateBadge(): bool;

    /**
     * Image object (see image component), svg or raster image.
     */
    public function getImage(): mixed;

    /**
     * Icon name as a string.
     */
    public function getIcon(): string;

}
