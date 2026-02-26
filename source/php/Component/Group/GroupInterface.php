<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Group;

use ComponentLibrary\Component\ComponentInterface;

interface GroupInterface extends ComponentInterface
{
    /**
     * What direction to group (horizontal or vertical).
     */
    public function getDirection(): string;

    /**
     * Justify the content to either position (ex. left, center, right).
     */
    public function getJusitifyContent(): string;

    /**
     * Alignment of the content items (ex. center).
     */
    public function getAlignItems(): string;

    /**
     * Alignment of the content (ex. end).
     */
    public function getAlignContent(): string;

    /**
     * Display.
     */
    public function getDisplay(): string;

    /**
     * Wrap the content (ex. nowrap, wrap, wrap-reverse).
     */
    public function getWrap(): string;

    /**
     * Allow to grow the content within the group.
     */
    public function getFlexGrow(): bool;

    /**
     * Allow to shrink the content within the group.
     */
    public function getFlexShrink(): bool;

    /**
     * A number between 1-10 that sets the gap between flexed elements.
     */
    public function getGap(): string;

    /**
     * Uses flexbox and media queries to determine amount of items per row. Can be a number between 1-4 which will determine the maximum amount of items per row.
     */
    public function getFluidGrid(): mixed;

    /**
     * Number of items per row. (number between 1-12).
     */
    public function getColumns(): mixed;

}
