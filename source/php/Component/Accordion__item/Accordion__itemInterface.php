<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Accordion__item;

use ComponentLibrary\Component\ComponentInterface;

interface Accordion__itemInterface extends ComponentInterface
{
    /**
     * ID for the accordion.
     */
    public function getId(): string;

    /**
     * The heading.
     */
    public function getHeading(): string|array;

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
     * Array of taxonomies such as tags.
     */
    public function getTaxonomy(): array;

    /**
     * Taxonomy position like top or below.
     */
    public function getTaxonomyPosition(): string;

    /**
     * Icon to show for expand functionality.
     */
    public function getIcon(): string;

}
