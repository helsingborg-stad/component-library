<?php

namespace ComponentLibrary\Component\Field;

class Field extends \ComponentLibrary\Component\Form\Form implements FieldInterface
{
    private $disallowedAttributeKeys = [
        'required',
        'autocomplete',
        'name',
        'type',
        'value',
        'rows',
        'data-validation-message',
        'data-validation-regexp',
    ];

    private $validAutocompleteValues = [
        'on',
        'off',
        'honorific-prefix',
        'given-name',
        'additional-name',
        'family-name',
        'honorific-suffix',
        'nickname',
        'email',
        'username',
        'new-password',
        'current-password',
        'one-time-code',
        'organization-title',
        'street-address',
        'address-line1',
        'address-line2',
        'address-line3',
        'address-level4',
        'address-level3',
        'address-level2',
        'address-level1',
        'country',
        'country-name',
        'postal-code',
        'cc-name',
        'cc-given-name',
        'cc-additional-name',
        'cc-family-name',
        'cc-number',
        'cc-exp',
        'cc-exp-month',
        'cc-exp-year',
        'cc-csc',
        'cc-type',
        'transaction-currency',
        'transaction-amount',
        'language',
        'bday',
        'bday-day',
        'bday-month',
        'bday-year',
        'sex',
        'tel',
        'tel-country-code',
        'tel-national',
        'tel-area-code',
        'tel-local',
        'tel-extension',
        'impp',
        'url',
        'photo',
    ];

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Warn & backwards compability for disallowedAttributeKeys,
        //TODO: Remove this backwards compatibility when all issues
        // are resolved. Keep warning for the future.
        $malformedAttributes = $this->malformedAttributeListWarning($attributeList);
        if (is_iterable($malformedAttributes)) {
            foreach ($malformedAttributes as $malformedAttributeKey => $malformedAttributeValue) {
                ${$malformedAttributeKey} = $malformedAttributeValue;
            }
        }

        // Must include a id.
        $id = $this->data['id'] = $this->sanitizeIdAttribute(!empty($this->data['id']) ? $this->data['id'] : uniqid());

        //Prevent e from being entered into number field
        if ($type == 'number') {
            $this->data['fieldAttributeList']['onkeydown'] = 'return event.keyCode !== 69';
        }

        //Prevent + from being entered into email field
        if ($type == 'email') {
            $this->data['fieldAttributeList']['onkeydown'] = 'return event.keyCode !== 107';
        }

        //Regular expression for validation purposes
        if ($validationRegexp) {
            $this->data['fieldAttributeList']['data-validation-regexp'] = $validationRegexp;
        }

        //Invalid message
        if ($invalidMessage) {
            $this->data['fieldAttributeList']['data-validation-message'] = $invalidMessage;
        }

        //Multiline
        if (is_numeric($multiline)) {
            $this->data['fieldAttributeList']['rows'] = $multiline;
            $this->data['fieldAttributeList']['style'] = 'resize: none;';
        }

        //Label visibility
        $this->data['showLabel'] = !$hideLabel && !empty($label);
        if ($this->data['showLabel']) {
            $this->data['fieldAttributeList']['aria-labelledby'] = 'label_' . $id;
        } else {
            $this->data['fieldAttributeList']['aria-label'] = $label;
        }

        //Set type
        $this->data['classList'][] = $this->getBaseClass() . '--' . $type;

        //Handle icon
        $this->data['icon'] = $this->getIcon($icon, $size);
        if ($this->data['icon']) {
            $this->data['classList'][] = $this->getBaseClass('icon', true);
        }

        //Normalize size
        if (!in_array($size, ['sm', 'md', 'lg'])) {
            $size = 'md';
        }
        $this->data['classList'][] = $this->getBaseClass($size, true);

        // Is valid indicator
        if (isset($isValid) && $isValid === true) {
            $this->data['classList'][] = 'is-valid';
        } elseif (isset($isValid) && $isValid === false) {
            $this->data['classList'][] = 'is-invalid';
        }

        //Borderless
        if ($borderless) {
            $this->data['classList'][] = $this->getBaseClass('borderless', true);
        }

        //Borderless
        if ($shadow) {
            $this->data['classList'][] = $this->getBaseClass('shadow', true);
        }

        //Handle radius
        if ($this->data['radius']) {
            $this->data['classList'][] = $this->getBaseClass() . '--radius-' . $this->data['radius'];
        }

        // Make backwards compatible
        if ($type === 'datepicker') {
            $type = 'date';
        } elseif ($type === 'datetime') {
            $type = 'datetime-local';
        }

        // Handle datepicker exceptions
        if (in_array($type, ['time', 'datetime-local', 'date'])) {
            if (isset($datepicker['required']) && $datepicker['required']) {
                $this->data['required'] = true;
            }

            $this->setMinAndMaxDate(
                $datepicker['minDate'] ?? false,
                $datepicker['maxDate'] ?? false,
                $this->data['type'],
            );
        }

        //Move field specific attributes to field element.
        if ($moveAttributesListToFieldAttributes) {
            $this->data['fieldAttributeList'] = array_merge(
                $this->data['fieldAttributeList'],
                $this->data['attributeList'],
            );
        }

        //Remove field specific attributes from main element.
        if ($moveAttributesListToFieldAttributes) {
            $this->data['attributeList'] = array_filter(
                $this->data['attributeList'],
                array($this, 'isNotFieldAttribute'),
                ARRAY_FILTER_USE_KEY,
            );
        }

        //Placeholder
        if ($placeholder) {
            $this->data['fieldAttributeList']['placeholder'] = $placeholder;
        }

        // Type
        if ($type) {
            $this->data['fieldAttributeList']['type'] = $type;
        }

        // Type
        if ($name) {
            $this->data['fieldAttributeList']['name'] = $name;
        }

        // Handle required, as attribute and var
        if ($required) {
            $this->data['fieldAttributeList']['required'] = 'required';
            $this->data['fieldAttributeList']['data-js-required'] = '';
            $this->data['fieldAttributeList']['data-required'] = '1';
            $this->data['fieldAttributeList']['aria-required'] = 'true';
        }

        // Autocomplete
        if ($autocomplete) {
            if (!in_array($autocomplete, $this->validAutocompleteValues)) {
                trigger_error(
                    sprintf(
                        'Attribute "%s" is not a valid autocomplete value. 
                        The component will fallback to generic "on" value. 
                        Please set one of these: %s',
                        $autocomplete,
                        implode(', ', $this->validAutocompleteValues),
                    ),
                    E_USER_WARNING,
                );

                $autocomplete = 'on';
            }

            $this->data['fieldAttributeList']['autocomplete'] = $autocomplete;
        } else {
            $this->data['fieldAttributeList']['autocomplete'] = 'off';
        }

        /* Customizer */
        if ($hideLabel) {
            if (empty($placeholder) && !empty($label)) {
                $this->data['fieldAttributeList']['placeholder'] = $label;
            }
        }

        //Create field attributes
        $this->data['fieldAttribute'] = self::buildAttributes(
            $this->data['fieldAttributeList'],
        );
    }

    /**
     * Get a icon, set default vars.
     *
     * @param array|bool $icon
     * @return array|bool
     */
    public function getIcon(array $icon, string $size): array|null
    {
        if (is_array($icon) && !empty($icon)) {
            return array_merge([
                'size' => $this->getIconSize($size),
                'icon' => 'search',
            ], $icon);
        }

        return null;
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

        $minDate
            ? ($this->data['fieldAttributeList']['min'] = date(
                \ComponentLibrary\Helper\Date::getDateFormat($type),
                strtotime($minDate),
            ))
            : '';

        $maxDate
            ? ($this->data['fieldAttributeList']['max'] = date(
                \ComponentLibrary\Helper\Date::getDateFormat($type),
                strtotime($maxDate),
            ))
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
        return (bool) !in_array($key, [
            'class',
            'data-uid',
            'id',
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

    /**
     * Sniff attributes list, to find stuff that dosent belong.
     * Refer to the component parameters.
     *
     * @param array $attributeList
     * @return bool
     */
    private function malformedAttributeListWarning($attributeList)
    {
        if (is_iterable($attributeList)) {
            $stack = []; //Malformed attribute detection stack
            foreach ($attributeList as $key => $attribute) {
                if (in_array($key, $this->disallowedAttributeKeys)) {
                    trigger_error(
                        sprintf(
                            'Attribute "%s" is not allowed in attribute list. 
                            Please use the respective parameter. Component will 
                            run in compability mode until this issue is resolved. 
                            Attributes will override the component parameter.',
                            $key,
                        ),
                        E_USER_WARNING,
                    );
                    $stack[$key] = $attribute;
                }
            }
            return $stack;
        }

        return false;
    }

    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'field';
    }

    // -------------------------------------------------------------------------
    // FieldInterface — generated getters
    // -------------------------------------------------------------------------

    public function getLabel(): string
    {
        return $this->data['label'] ?? '';
    }

    public function getType(): string
    {
        return $this->data['type'] ?? 'text';
    }

    public function getValidationRegexp(): bool
    {
        return $this->data['validationRegexp'] ?? false;
    }

    public function getInvalidMessage(): bool
    {
        return $this->data['invalidMessage'] ?? false;
    }

    public function getRequired(): bool
    {
        return $this->data['required'] ?? false;
    }

    public function getAutocomplete(): string
    {
        return $this->data['autocomplete'] ?? 'on';
    }

    public function getValue(): string
    {
        return $this->data['value'] ?? '';
    }

    public function getSize(): string
    {
        return $this->data['size'] ?? 'md';
    }

    public function getRadius(): string
    {
        return $this->data['radius'] ?? 'md';
    }

    public function getPlaceholder(): string
    {
        return $this->data['placeholder'] ?? '';
    }

    public function getHideLabel(): bool
    {
        return $this->data['hideLabel'] ?? false;
    }

    public function getHelperText(): string
    {
        return $this->data['helperText'] ?? '';
    }

    public function getMultiline(): bool
    {
        return $this->data['multiline'] ?? false;
    }

    public function getBorderless(): bool
    {
        return $this->data['borderless'] ?? false;
    }

    public function getShadow(): bool
    {
        return $this->data['shadow'] ?? false;
    }

    public function getFieldAttributeList(): array
    {
        return $this->data['fieldAttributeList'] ?? [];
    }

    public function getMoveAttributesListToFieldAttributes(): bool
    {
        return $this->data['moveAttributesListToFieldAttributes'] ?? true;
    }

    public function getDescription(): string
    {
        return $this->data['description'] ?? '';
    }
}
