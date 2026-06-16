<?php

namespace ComponentLibrary\Component\Accordion;

/**
 * Class Accordion
 * @package ComponentLibrary\Component\Accordion
 */
class Accordion extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData'] = $this->slotHasData('slot');

        $this->data['classList'][] = $this->getBaseClass();

        if ($spacing) {
            $this->data['classList'][] = $this->getBaseClass('spaced', true);
        }

        if ($border && !$divider) {
            $this->data['classList'][] = $this->getBaseClass('bordered', true);
        }

        if ($divider) {
            $this->data['classList'][] = $this->getBaseClass('divided', true);
        }

        $this->data['heading'] = $this->getHeading();
        $headingCount = $this->getHeadingCount() ?? 0;

        $this->data['attributeList']['style'] = $headingCount > 0 ? '--' . $this->getBaseClass() . '--heading-count: ' . $headingCount . ';' : '1';

        $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
    }

    private function getHeading(): ?array {
        $heading = $this->data['heading'] ?? null;

        if (empty($heading)) {
            return null;
        }

        if (!empty($heading) && !is_array($heading)) {
            $heading = [$heading];
        }

        return $heading;
    }

    private function getHeadingCount(): int {
        if (empty($this->data['heading'])) {
            return 1;
        }

        return count($this->data['heading']);
    }
}
