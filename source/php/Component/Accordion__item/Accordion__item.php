<?php

namespace ComponentLibrary\Component\Accordion__item;

/**
 * Class Accordion
 * @package ComponentLibrary\Component\Accordion
 */
class Accordion__item extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        $this->data['id'] = $this->sanitizeIdAttribute(uniqid());

        array_unshift($this->data['classList'], $this->data['baseClass']);

        $this->data['heading'] = $this->getHeading();
        $headingCount = $this->getHeadingCount();

        $this->data['classList'][] = $this->getBaseClass();

        if ($border) {
            $this->data['classList'][] = $this->getBaseClass('bordered', true);
        }

        $this->data['attributeList']['style'] = $headingCount > 0 ? '--' . $this->getBaseClass() . '--heading-count: ' . $headingCount . ';' : '1';
    }

    private function getHeading() {
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
