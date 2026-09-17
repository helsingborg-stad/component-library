<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Accordion;

/**
 * Typed input contract for the Accordion component.
 */
final class AccordionData
{
    /**
     * @param string $id The accordion DOM id.
     * @param string|array $heading The optional heading or headings.
     * @param AccordionItemData[] $list The accordion items.
     * @param bool $spacing Whether sections are spaced.
     * @param bool $border Whether the accordion shows a border.
     * @param bool $divider Whether the accordion shows dividers.
     */
    public function __construct(
        public string $id = '',
        public string|array $heading = '',
        public array $list = [],
        public bool $spacing = false,
        public bool $border = true,
        public bool $divider = false,
    ) {}
}
