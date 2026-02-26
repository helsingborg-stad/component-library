<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Icon;

use ComponentLibrary\Component\ComponentInterface;

interface IconInterface extends ComponentInterface
{
    /**
     * Sizes: xs, sm, md, lg, xl, xxl.
     */
    public function getSize(): string;

    /**
     * A label on the icon.
     */
    public function getLabel(): string;

    /**
     * The icon name or a url to a svg file.
     */
    public function getIcon(): string;

    /**
     * The color of the icon.
     */
    public function getColor(): string;

    /**
     * A custom HEX color.
     */
    public function getCustomColor(): string;

    /**
     * Icon HTML tag.
     */
    public function getComponentElement(): string;

    /**
     * If the icons should be filled or not.
     */
    public function getFilled(): bool;

    /**
     * If the icon is decorative only or serves a purpose.
     */
    public function getDecorative(): bool;

}
