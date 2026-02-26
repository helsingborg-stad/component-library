<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Hero;

use ComponentLibrary\Component\ComponentInterface;

interface HeroInterface extends ComponentInterface
{
    /**
     * Background image.
     */
    public function getImage(): mixed;

    /**
     * Where to focus in the background.
     */
    public function getImageFocus(): object;

    /**
     * Display a video as a background. This option will replace image.
     */
    public function getVideo(): string;

    /**
     * Ratio (normal, large).
     */
    public function getSize(): string;

    /**
     * The title text.
     */
    public function getTitle(): string;

    /**
     * The byline text.
     */
    public function getByline(): string;

    /**
     * The body text.
     */
    public function getParagraph(): string;

    /**
     * Always stretch the hero vertically. Makes the hero the width of the viewport. Requires a centered container.
     */
    public function getStretch(): bool;

    /**
     * Name of the animation.
     */
    public function getAnimation(): string;

    /**
     * Label provided for accessibility tools such as screen readers.
     */
    public function getAriaLabel(): string;

    /**
     * Select which view to display.
     */
    public function getHeroView(): string;

    /**
     * An array containing the custom data for the selected view (heroView).
     */
    public function getCustomHeroData(): array;

    /**
     * The meta text.
     */
    public function getMeta(): string;

    /**
     * Image or a color.
     */
    public function getBackground(): string;

    /**
     * The color of the text.
     */
    public function getTextColor(): string;

    /**
     * Alignment texts. Supports "left", "center" and "right".
     */
    public function getTextAlignment(): string;

    /**
     * The background color for texts in the content area.
     */
    public function getContentBackgroundColor(): string;

    /**
     * Vertical placement of the content: top|center|bottom.
     */
    public function getContentAlignmentVertical(): string;

    /**
     * ContentAlignmentHorizontal.
     */
    public function getContentAlignmentHorizontal(): string;

    /**
     * Apply rounded corners to content if contentBackgroundColor is set.
     */
    public function getContentApplyRoundedCorners(): bool;

    /**
     * Apply shadows to content if contentBackgroundColor is set.
     */
    public function getContentApplyShadows(): bool;

    /**
     * Add a @button by passing @button component arguments. If button is treated as a link, all te text elements in the content gets wrapped with this link.
     */
    public function getButtonArgs(): array;

    /**
     * Poster image for the video.
     */
    public function getPoster(): bool;

    /**
     * Add an overlay over an image to make text more legible.
     */
    public function getOverlay(): string;

    /**
     * Content slot to be displayed in the hero.
     */
    public function getContent(): string|bool;

}
