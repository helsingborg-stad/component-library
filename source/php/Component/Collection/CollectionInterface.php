<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Collection;

use ComponentLibrary\Component\ComponentInterface;

interface CollectionInterface extends ComponentInterface
{
    /**
     * The element type of list.
     */
    public function getComponentElement(): string;

    /**
     * A array input list, contains 'content' and 'link' array keys.
     */
    public function getList(): array|bool;

    /**
     * Adds borders.
     */
    public function getBordered(): bool;

    /**
     * If the list should be displayed in a compressed format.
     */
    public function getCompact(): bool;

    /**
     * Every single edge as sharp as hell, be careful!.
     */
    public function getSharp(): bool;

    /**
     * Makes the bottom really sharp. Yep.
     */
    public function getSharpBottom(): bool;

    /**
     * Makes the top really sharp. Yep.
     */
    public function getSharpTop(): bool;

    /**
     * Removes the border.
     */
    public function getUnbox(): bool;

}
