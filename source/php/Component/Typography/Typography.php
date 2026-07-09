<?php

namespace ComponentLibrary\Component\Typography;

class Typography extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);
        
        if ($autopromote) {
            $this->data['attributeList']['data-autopromote'] = "1";
        }

        $this->data['classList'][] = $this->getBaseClass() . "__variant--" . $this->getVariant($variant);
    }

    private function getVariant($variant) {
        $element = $this->data['element'];
        $headings = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

        if (!$variant) {
            return $element;
        }
        
        if (in_array($element, $headings) && !in_array($variant, $headings)) {
            trigger_error(
                sprintf(
                    'Element "%s" and variant "%s" cannot be combined. Heading elements must use a heading variant.',
                    $element,
                    $variant
                ),
                E_USER_WARNING
            );

            return $element;
        }

        return $variant;
    }
}
