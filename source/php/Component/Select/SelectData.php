<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Select;

/**
 * Typed input contract for the Select component.
 */
final class SelectData
{
    public function __construct(
        public string $label = '',
        public string $placeholder = '',
        public string|bool $id = false,
        public string $description = '',
        public bool $required = false,
        public array $options = [],
        public string|bool $errorMessage = false,
        public string|bool $preselected = false,
        public bool $multiple = false,
        public string|bool $name = false,
        public bool $hideLabel = false,
        public string $helperText = '',
        public string $size = 'md',
        public int|bool $maxSelections = false,
        public bool $hidePlaceholder = false,
        public array $selectAttributeList = [],
        public ?bool $search = null,
        public string $searchPlaceholder = 'Search...',
        public string $searchNoResultsText = 'No results found',
    ) {}
}
