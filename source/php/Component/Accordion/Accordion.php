<?php

namespace ComponentLibrary\Component\Accordion;

/**
 * Class Accordion
 * @package ComponentLibrary\Component\Accordion
 */
class Accordion extends \ComponentLibrary\Component\BaseController implements AccordionInterface
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData']         = $this->slotHasData('slot');

        if ($spacedSections) {
            $this->data['classList'] = ['c-accordion--spaced-sections'];
        }

        $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'accordion';
    }

    // -------------------------------------------------------------------------
    // AccordionInterface — generated getters
    // -------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->data['id'] ?? '';
    }

    public function getList(): array
    {
        return $this->data['list'] ?? [];
    }

    public function getBeforeHeading(): string
    {
        return $this->data['beforeHeading'] ?? '';
    }

    public function getAfterHeading(): string
    {
        return $this->data['afterHeading'] ?? '';
    }

    public function getBeforeContent(): string
    {
        return $this->data['beforeContent'] ?? '<p>';
    }

    public function getAfterContent(): string
    {
        return $this->data['afterContent'] ?? '</p>';
    }

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getSectionElement(): string
    {
        return $this->data['sectionElement'] ?? 'div';
    }

    public function getSectionHeadingElement(): string
    {
        return $this->data['sectionHeadingElement'] ?? 'button';
    }

    public function getSectionContentElement(): string
    {
        return $this->data['sectionContentElement'] ?? 'div';
    }

    public function getSpacedSections(): bool
    {
        return $this->data['spacedSections'] ?? false;
    }

    public function getTaxonomy(): array
    {
        return $this->data['taxonomy'] ?? [];
    }

    public function getTaxonomyPosition(): string
    {
        return $this->data['taxonomyPosition'] ?? '';
    }
}
