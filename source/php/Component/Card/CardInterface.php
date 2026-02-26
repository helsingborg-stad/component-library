<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\Component\ComponentInterface;

interface CardInterface extends ComponentInterface
{
    /**
     * A smaller heading above the primary one.
     */
    public function getEyebrow(): string;

    /**
     * The card heading.
     */
    public function getHeading(): string;

    /**
     * A subheading below the heading, explaining more stuff.
     */
    public function getSubHeading(): string;

    /**
     * Small text below title, in meta style.
     */
    public function getMeta(): string;

    /**
     * The card content.
     */
    public function getContent(): string;

    /**
     * Array with buttons that has parameters like href, text and attributeList.
     */
    public function getButtons(): array;

    /**
     * A url to an image.
     */
    public function getImage(): mixed;

    /**
     * The ratio of the image.
     */
    public function getRatio(): string;

    /**
     * If the content should be collapsible.
     */
    public function getCollapsible(): bool;

    /**
     * A tags array.
     */
    public function getTags(): array;

    /**
     * A hyperlink to another location.
     */
    public function getLink(): string;

    /**
     * The text of the link, if not set, the link will not be displayed.
     */
    public function getLinkText(): string;

    /**
     * Preformatted date.
     */
    public function getDate(): array;

    /**
     * Display date as a badge. Requires image to be set.
     */
    public function getDateBadge(): bool;

    /**
     * If the card should have a placeholder, if the image is missing.
     */
    public function getHasPlaceholder(): bool;

    /**
     * An array with the same specification as the icon component.
     */
    public function getIcon(): bool|array;

    /**
     * The background color of the icon.
     */
    public function getIconBackgroundColor(): string;

    /**
     * The background color of the image.
     */
    public function getColor(): string;

    /**
     * If the meta should be displayed before the heading.
     */
    public function getMetaFirst(): bool;

    /**
     * If the headings should be displayed above the image.
     */
    public function getHeadingAboveImage(): bool;

}
