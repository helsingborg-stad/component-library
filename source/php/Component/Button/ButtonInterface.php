<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Button;

use ComponentLibrary\Component\ComponentInterface;

interface ButtonInterface extends ComponentInterface
{
    /**
     * The text-content of a button.
     */
    public function getText(): string;

    /**
     * The size of the button; sm, md, lg.
     */
    public function getSize(): string;

    /**
     * The color scheme for the button.
     */
    public function getColor(): string;

    /**
     * What button type.
     */
    public function getType(): string;

    /**
     * The type of appearance, can be basic, filled or outlined.
     */
    public function getStyle(): string;

    /**
     * If the shape of the button should be normal, or fully rounded (pill style).
     */
    public function getShape(): string;

    /**
     * Where should the button link to?.
     */
    public function getHref(): ?string;

    /**
     * Open a new tab or not?.
     */
    public function getTarget(): string;

    /**
     * The tag to use for this component.
     */
    public function getComponentElement(): string;

    /**
     * The element containing the label.
     */
    public function getLabelElement(): string;

    /**
     * Enable / disable ripple on click.
     */
    public function getRipple(): bool;

    /**
     * Pressed.
     */
    public function getPressed(): string;

    /**
     * Will toggle the color of the font.
     */
    public function getToggle(): bool;

    /**
     * The name of the icon.
     */
    public function getIcon(): string;

    /**
     * Reverse the position of icon and text.
     */
    public function getReversePositions(): bool;

    /**
     * Makes button full width.
     */
    public function getFullWidth(): bool;

    /**
     * Array of classes placed on the icon.
     */
    public function getClassListIcon(): array;

    /**
     * Array of classes placed on the text.
     */
    public function getClassListText(): array;

    /**
     * Aria label text for the button.
     */
    public function getAriaLabel(): string;

    /**
     * To use or not to use the disabled color even if the button is disabled.
     */
    public function getDisableColor(): bool;

}
