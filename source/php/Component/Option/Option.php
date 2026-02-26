<?php

namespace ComponentLibrary\Component\Option;

/**
 * Class Option
 * @package ComponentLibrary\Component\Option
 */
class Option extends \ComponentLibrary\Component\BaseController implements OptionInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $id = $this->data['id'] = $this->sanitizeIdAttribute(!empty($this->data['id']) ? $this->data['id'] : uniqid());

        if (!empty($name)) {
            $this->data['attributeList']['name'] = $name;
        } else if (!empty($this->data['attributeList']['name'])) {} else {
            $this->data['attributeList']['name'] = $label;
        }

        if (!empty($required)) {
             $this->data['attributeList']['required'] = true;
        }

        if (empty($value) && !empty($this->data['attributeList']['value'])) {
            $this->data['value'] = $this->data['attributeList']['value'];
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'option';
    }

    // -------------------------------------------------------------------------
    // OptionInterface — generated getters
    // -------------------------------------------------------------------------

    public function getType(): string
    {
        return $this->data['type'] ?? 'checkbox';
    }

    public function getLabel(): string
    {
        return $this->data['label'] ?? '';
    }

    public function getRequired(): bool
    {
        return $this->data['required'] ?? false;
    }

    public function getValue(): string
    {
        return $this->data['value'] ?? '';
    }

    public function getChecked(): bool
    {
        return $this->data['checked'] ?? false;
    }
}
