<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Slider__item;

use ComponentLibrary\Component\ComponentInterface;

interface Slider__itemInterface extends ComponentInterface
{
    /**
     * A title for predefined layout.
     */
    public function getTitle(): string|bool;

    /**
     * A text for predefined layout.
     */
    public function getText(): string|bool;

    /**
     * Adds button with a link, should conform with the button component specification (title, href).
     */
    public function getCta(): array|bool;

    /**
     * An url or path to an image to use as background for the segment.
     */
    public function getImage(): mixed;

    /**
     * A video background for the segment.
     */
    public function getVideo(): bool|string;

    /**
     * Alternative text.
     */
    public function getAlt(): string;

    /**
     * Where the slide should link to.
     */
    public function getLink(): string|bool;

    /**
     * A description of the link.
     */
    public function getLinkDescription(): string;

    /**
     * Which layouts to use.
     */
    public function getLayout(): string;

    /**
     * The color palette to be used.
     */
    public function getTheme(): string;

    /**
     * Determines what color the container and text should be.
     */
    public function getContainerColor(): string;

    /**
     * Gives the slide a hero like appearance with larger text.
     */
    public function getHeroStyle(): string;

    /**
     * Aligns the text in the container.
     */
    public function getTextAlignment(): string;

    /**
     * Adds an overlay to the image.
     */
    public function getOverlay(): string;

    /**
     * A slot for custom content, placed above the predefined layout.
     */
    public function getSlot(): bool|string;

    /**
     * A slot for custom content, placed below the predefined layout.
     */
    public function getBottom(): bool|string;

}
