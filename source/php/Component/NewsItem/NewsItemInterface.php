<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\NewsItem;

use ComponentLibrary\Component\ComponentInterface;

interface NewsItemInterface extends ComponentInterface
{
    /**
     * Title of the item.
     */
    public function getHeading(): string;

    /**
     * Subheading of the item.
     */
    public function getSubHeading(): string;

    /**
     * Content of the item.
     */
    public function getContent(): string;

    /**
     * Image of the item, check @image for documentation.
     */
    public function getImage(): array;

    /**
     * Date of the item. Check @date for documentation.
     */
    public function getDate(): array;

    /**
     * Read time of the item.
     */
    public function getReadTime(): string;

    /**
     * If the item will be appearing standing or laying down.
     */
    public function getStanding(): bool;

    /**
     * Link to the item.
     */
    public function getLink(): string;

    /**
     * If the item has a placeholder image.
     */
    public function getHasPlaceholderImage(): bool;

}
