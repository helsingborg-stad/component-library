<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Button;

/**
 * Typed input contract for the Button component.
 */
final class ButtonData
{
    /**
     * @param string|null $text The visible label.
     * @param string $size The button size.
     * @param string $color The button color scheme.
     * @param string $type The HTML button type.
     * @param string $style The visual button style.
     * @param string $shape The visual button shape.
     * @param string|null $href The optional link target.
     * @param string $target The link target attribute.
     * @param string $componentElement The rendered wrapper element.
     * @param string $labelElement The element used around the label.
     * @param bool $ripple Whether the ripple effect is enabled.
     * @param string $pressed The pressed state value.
     * @param bool $toggle Whether the button behaves like a toggle.
     * @param string|null $icon The optional icon name.
     * @param bool $reversePositions Whether icon and text positions are reversed.
     * @param bool $fullWidth Whether the button should stretch to full width.
     * @param array $classListIcon Extra icon classes.
     * @param array $classListText Extra text classes.
     * @param string $ariaLabel The aria-label value.
     * @param bool $disableColor Whether disabled color handling is active.
     */
    public function __construct(
        public ?string $text = null,
        public string $size = 'md',
        public string $color = 'default',
        public string $type = 'button',
        public string $style = 'filled',
        public string $shape = 'normal',
        public ?string $href = null,
        public string $target = '_top',
        public string $componentElement = 'button',
        public string $labelElement = 'span',
        public bool $ripple = true,
        public string $pressed = 'false',
        public bool $toggle = false,
        public ?string $icon = null,
        public bool $reversePositions = false,
        public bool $fullWidth = false,
        public array $classListIcon = [],
        public array $classListText = [],
        public string $ariaLabel = '',
        public bool $disableColor = true,
    ) {
    }
}
