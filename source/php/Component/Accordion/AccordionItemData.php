<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Accordion;

/**
 * Typed item contract for entries rendered by the Accordion component.
 */
final class AccordionItemData
{
    /**
     * @param string|array $heading The accordion item heading or headings.
     * @param string $content The accordion item content.
     * @param string $id The optional DOM id.
     */
    public function __construct(
        public string|array $heading,
        public string $content,
        public string $id = '',
    ) {
    }
}
