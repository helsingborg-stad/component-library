<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Option;

final class OptionData
{
    /**
     * @param string $type The input type, checkbox or radio.
     * @param string $label The visible label. May contain HTML.
     * @param bool $required Whether the option is required.
     * @param string $value The input value.
     * @param bool $checked Whether the option is checked.
     * @param string|null $name The input name. Falls back to the label.
     * @param string $appearance The visual appearance, 'default' or 'card'.
     * @param string $description Secondary text shown below the label. Rendered escaped
     *                            and linked to the input with aria-describedby.
     * @param array $stateIndicator Short status tag shown next to the label, e.g.
     *                              ['text' => 'Permit required', 'state' => 'danger'].
     *                              State is one of neutral (default), success, warning or danger.
     */
    public function __construct(
        public string $type = 'checkbox',
        public string $label = '',
        public bool $required = false,
        public string $value = '',
        public bool $checked = false,
        public ?string $name = null,
        public string $appearance = 'default',
        public string $description = '',
        public array $stateIndicator = [],
    ) {}
}
