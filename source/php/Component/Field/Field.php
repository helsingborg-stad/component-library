<?php

namespace ComponentLibrary\Component\Field;

class Field extends \ComponentLibrary\Component\Form\Form
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if (!$id) {
            $this->data['id'] = uniqid();
        }

        $this->compParams = [
            'label' => $label ?? '',
            'type' => $type ?? 'text',
            'required' => $required ?? false,
            'invalidMessage' => $invalidMessage ?? '',
            'value' => $value ?? '',
            'isValid' => $isValid ?? null,
            'helperText' => $helperText ?? $invalidMessage ?? '',
            'hideLabel' => $hideLabel ?? false,
        ];

        $this->data['showLabel'] = !$hideLabel && !empty($label);

        if ($this->data['showLabel']) {
            $this->data['attributeList']['aria-labelledby'] = 'label_' . $this->data['id'];
        } else {
            $this->data['attributeList']['aria-label'] = $label;
        }

        //Set type
        $this->data['classList'][] = $this->getBaseClass() . "--" . $type;

        //Handle icon
        $this->data['icon'] = $this->getIcon($icon, $size);
        if ($this->data['icon']) {
            $this->data['classList'][] = $this->getBaseClass() . "--icon";
        }

        //Handle size
        if (!in_array($size, ['sm', 'md', 'lg'])) {
            $size = "md";
        }
        $this->data['classList'][] = $this->getBaseClass() . "--" . $size;

        if (isset($isValid) && $isValid === true) {
            $this->data['classList'][] = 'is-valid';
        } elseif (isset($isValid) && $isValid === false) {
            $this->data['classList'][] = 'is-invalid';
        }

        //Handle radius
        if ($this->data['radius']) {
            $this->data['classList'][] = $this->getBaseClass() . "--radius-" . $this->data['radius'];
        }

        // Set data
        $this->setData();

        // Make backwards compatible
        if ($type === 'datepicker') {
            $type = 'date';
        } elseif ($type === 'datetime') {
            $type = 'datetime-local';
        } 

        // Handle datepicker exceptions
        if ($type === 'date' || $type === 'datetime-local' || $type === 'time') {
            $this->data['type'] = $type;
            $this->compParams['type'] = $type;

            if($datepicker['required']) {
                $this->data['required'] = true;
            }

            $this->setMinAndMaxDate($datepicker['minDate'] ?? false, $datepicker['maxDate'] ?? false, $this->data['type']);
        }
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
                'icon' => 'search'
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

    public function setData()
    {
        $this->data['label'] = $this->compParams['label'];
        $this->data['type'] = $this->compParams['type'];
        $this->data['required'] = $this->compParams['required'];
        $this->data['invalidMessage'] = $this->compParams['invalidMessage'];
        $this->data['value'] = $this->compParams['value'];
    }

    public function setMinAndMaxDate($minDate, $maxDate, $type = 'date')
    {
        switch ($type) {
            case 'time':
                $format = 'H:i';
                break;
            case 'date':
                $format = 'Y-m-d';
                break;
            case 'datetime-local':
                $format = 'Y-m-d\TH:i';
                break;
        }

        $minDate ?
            $this->data['attributeList']['min'] = date($format, strtotime($minDate))
            : '';
        $maxDate ?
            $this->data['attributeList']['max'] = date($format, strtotime($maxDate))
            : '';
    }
}
