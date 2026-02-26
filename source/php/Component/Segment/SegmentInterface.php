<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Segment;

use ComponentLibrary\Component\ComponentInterface;

interface SegmentInterface extends ComponentInterface
{
    /**
     * Which layout to use.
     */
    public function getLayout(): string;

    /**
     * The title of the segment.
     */
    public function getTitle(): string|bool;

    /**
     * The content of the segment.
     */
    public function getContent(): string|bool;

    /**
     * The sizing of the font.
     */
    public function getTextSize(): string;

    /**
     * Add a URL for an image.
     */
    public function getImage(): mixed;

    /**
     * The background color, hex value or a color name (i.e. primary, secondary, etc).
     */
    public function getBackground(): string;

    /**
     * Which overlay to use.
     */
    public function getBackgroundOverlay(): string;

    /**
     * Color of the text.
     */
    public function getTextColor(): string;

    /**
     * Height behavior of the sections height.
     */
    public function getHeight(): string;

    /**
     * If it should have padding in the top.
     */
    public function getPaddingTop(): bool;

    /**
     * If it should have padding in the bottom.
     */
    public function getPaddingBottom(): bool;

    /**
     * How to align the text vertically.
     */
    public function getTextAlignment(): string;

    /**
     * If image and text should change order.
     */
    public function getReverseColumns(): bool;

    /**
     * Add an overlay over an image to make text more legible.
     */
    public function getOverlay(): string;

    /**
     * Always stretch the section vertically. Makes the section the width of the viewport. Requires a centered container.
     */
    public function getStretch(): bool;

    /**
     * Array of buttons according to the @button specification. Do not use more than two buttons, one primary and on secondary.
     */
    public function getButtons(): array;

    /**
     * The date.
     */
    public function getDate(): string|bool;

    /**
     * The meta text.
     */
    public function getMeta(): string|bool;

    /**
     * Array of tags according to the tags component.
     */
    public function getTags(): array|bool;

    /**
     * An array with the same specification as the icon component.
     */
    public function getIcon(): array|bool;

    /**
     * The background color of the icon.
     */
    public function getIconBackgroundColor(): string;

    /**
     * Link will be applied to the title and the image (if any). If there is one (1) button defined and no link is defined, the button will be used as the link.
     */
    public function getLink(): string|bool;

    /**
     * Sets image specific styling based on the image being a placholder image.
     */
    public function getHasPlaceholder(): bool;

    /**
     * An array with labels used in the component.
     */
    public function getLang(): array|bool;

}
