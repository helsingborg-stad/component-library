<?php

namespace ComponentLibrary\Component\Field;

class Field extends \ComponentLibrary\Component\Form\Form
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Must include a id.
        if (!$id) {
            $this->data['id'] = uniqid();
        }

        //Label visibility
        $this->data['showLabel'] = !$hideLabel && !empty($label);
        if ($this->data['showLabel']) {
            $this->data['fieldAttributeList']['aria-labelledby'] = 'label_' . $this->data['id'];
        } else {
            $this->data['fieldAttributeList']['aria-label'] = $label;
        }

        //Set type
        $this->data['classList'][] = $this->getBaseClass() . "--" . $type;

        //Handle icon
        $this->data['icon'] = $this->getIcon($icon, $size);
        if ($this->data['icon']) {
            $this->data['classList'][] = $this->getBaseClass() . "--icon";
        }

        //Normalize size
        if (!in_array($size, ['sm', 'md', 'lg'])) {
            $size = "md";
        }
        $this->data['classList'][] = $this->getBaseClass() . "--" . $size;

        // Is valid indicator
        if (isset($isValid) && $isValid === true) {
            $this->data['classList'][] = 'is-valid';
        } elseif (isset($isValid) && $isValid === false) {
            $this->data['classList'][] = 'is-invalid';
        }

        //Borderless
        if ($borderless) {
            $this->data['classList'][] = $this->getBaseClass() . "--borderless";
        }

        //Handle radius
        if ($this->data['radius']) {
            $this->data['classList'][] = $this->getBaseClass() . "--radius-" . $this->data['radius'];
        }

        // Make backwards compatible
        if ($type === 'datepicker') {
            $type = 'date';
        } elseif ($type === 'datetime') {
            $type = 'datetime-local';
        }

        // Handle datepicker exceptions
        if ($type === 'date' || $type === 'datetime-local' || $type === 'time') {

            if (isset($datepicker['required']) && $datepicker['required']) {
                $this->data['required'] = true;
            }

            $this->setMinAndMaxDate(
                $datepicker['minDate'] ?? false,
                $datepicker['maxDate'] ?? false,
                $this->data['type']
            );
        }

        //Move field specific attributes to field element.
        $this->data['fieldAttributeList'] = $this->moveAttributes(
            $this->data['attributeList'],
            $this->data['fieldAttributeList']
        );

        //Remove field specific attributes from main element.
        $this->data['attributeList'] = array_filter(
            $this->data['attributeList'],
            array($this, 'isNotFieldAttribute'),
            ARRAY_FILTER_USE_KEY
        );

        //Placeholder
        if ($placeholder) {
            $this->data['fieldAttributeList']['placeholder'] = $placeholder;
        }

        // Type
        if ($type) {
            $this->data['fieldAttributeList']['type'] = $type;
        }

        // Handle required
        if ($required) {
            $this->data['fieldAttributeList']['required']       = "required";
            $this->data['fieldAttributeList']['data-required']  = "1";
            $this->data['fieldAttributeList']['aria-required']  = "true";
        }

        // Autocomplete
        if ($autocomplete) {
            $this->data['fieldAttributeList']['autocomplete']  = "on";
        } else {
            $this->data['fieldAttributeList']['autocomplete']  = "off";
        }

        //Create field attributes
        $this->data['fieldAttribute'] = self::buildAttributes(
            $this->data['fieldAttributeList']
        );
    }

    /**
     * Get a icon, set default vars.
     *
     * @param array|bool $icon
     * @return array|bool
     */
    public function getIcon($icon, $size)
    {
        if (is_array($icon) && !empty($icon)) {
            return array_merge([
                'size' => $this->getIconSize($size),
                'icon' => 'search',
            ], $icon);
        }

        return false;
    }

    /**
     * Select appropriate icon size based on field size
     *
     * @param string $fieldSize
     * @return string
     */
    public function getIconSize($fieldSize)
    {
        switch ($fieldSize) {
            case 'sm':
                return 'sm';
                break;
            default:
                return 'md';
                break;
        }
    }

    /**
     * Set a minimum and maximum date to be selectable
     *
     * @param string $minDate
     * @param string $maxDate
     * @param string $type
     * @return void
     */
    public function setMinAndMaxDate($minDate, $maxDate, $type = 'date')
    {
        $type = $type === 'datetime-local' ? 'date-time' : $type;
        $format = \ComponentLibrary\Helper\Date::getDateFormat($type);

        $minDate ?
        $this->data['fieldAttributeList']['min'] = date($format, strtotime($minDate))
        : '';

        $maxDate ?
        $this->data['fieldAttributeList']['max'] = date($format, strtotime($maxDate))
        : '';
    }

    /**
     * Check if attribute should be placed in fieldAttributeList or attributeList
     *
     * @param   string  $key    The attribute key
     * @return  boolean         True is attribute, false if field attribute.
     */
    private function isFieldAttribute(string $key): bool
    {
        return (bool) in_array($key, [
            'type',
            'name',
            'pattern',
            'autocomplete',
            'data-invalid',
            'data-invalid-message',
            'message',
            'id'
        ]);
    }

    /**
     * Same as above but inverted
     *
     * @param   string  $key    The attribute key
     * @return  boolean 
     */
    private function isNotFieldAttribute(string $key): bool
    {
        return (bool) !$this->isFieldAttribute($key);
    }

    /**
     * Moves attributes to field attributeList
     */
    private function moveAttributes(array $attributeList, array $fieldAttributeList): array
    {
        if (is_iterable($attributeList)) {
            foreach ($attributeList as $key => $attribute) {
                if ($this->isFieldAttribute($key)) {
                    $fieldAttributeList[$key] = $attribute;
                }
            }
        }

        return $fieldAttributeList;
    }
}
