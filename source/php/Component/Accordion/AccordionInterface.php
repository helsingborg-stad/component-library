<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Accordion;

use ComponentLibrary\Component\ComponentInterface;

interface AccordionInterface extends ComponentInterface
{
    /**
     * ID for the accordion.
     */
    public function getId(): string;

    /**
     * List of accordion section.
     */
    public function getList(): array;

    /**
     * Insert before heading.
     */
    public function getBeforeHeading(): string;

    /**
     * Insert after heading.
     */
    public function getAfterHeading(): string;

    /**
     * Insert before content.
     */
    public function getBeforeContent(): string;

    /**
     * Insert after content.
     */
    public function getAfterContent(): string;

    /**
     * Component element.
     */
    public function getComponentElement(): string;

    /**
     * Section element.
     */
    public function getSectionElement(): string;

    /**
     * Section heading component.
     */
    public function getSectionHeadingElement(): string;

    /**
     * Section content component.
     */
    public function getSectionContentElement(): string;

    /**
     * Sections are spaced instead of glued together.
     */
    public function getSpacedSections(): bool;

    /**
     * Array of taxonomies such as tags.
     */
    public function getTaxonomy(): array;

    /**
     * Taxonomy position like top or below.
     */
    public function getTaxonomyPosition(): string;

}
