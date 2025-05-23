<?php

namespace ComponentLibrary\Component\Accordion__item;

/**
 * Class Accordion
 * @package ComponentLibrary\Component\Accordion
 */
class Accordion__item extends \ComponentLibrary\Component\BaseController
{
    private $heading;

    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['baseClass'] = 'c-accordion';
        $this->data['classList'][] = 'c-accordion__section';
        $this->data['id'] = $this->sanitizeIdAttribute(uniqid());

        $this->data['headingType']  = $this->headingType($this->heading) ? $this->data['baseClass'] . '__heading-is-array' : '';
        $this->data['ariaLabel']    = $this->headingType($this->heading) ? $this->heading[0] : $this->heading;

        //Removes duplicate baseclass (Autogenerated)
        if (function_exists('add_filter')) {
            add_filter('ComponentLibrary/Component/Accordion__item/Class', function ($class, $context) {
                return array_diff($class, ['c-accordion']);
            }, 10, 3);
        }
    }

    private function headingType($heading) {
        return !empty($heading) && is_array($heading);
    }
}
