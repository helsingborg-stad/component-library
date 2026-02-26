<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Collection__item;

use ComponentLibrary\Component\ComponentInterface;

interface Collection__itemInterface extends ComponentInterface
{
    /**
     * ComponentElement.
     */
    public function getComponentElement(): string;

    /**
     * Prefix.
     */
    public function getPrefix(): string;

    /**
     * Icon.
     */
    public function getIcon(): bool;

    /**
     * IconLast.
     */
    public function getIconLast(): bool;

    /**
     * Action.
     */
    public function getAction(): bool;

    /**
     * Secondary.
     */
    public function getSecondary(): string;

    /**
     * Link.
     */
    public function getLink(): string;

    /**
     * Shows a border around the item.
     */
    public function getBordered(): bool;

}
