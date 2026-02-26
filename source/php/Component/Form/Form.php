<?php

namespace ComponentLibrary\Component\Form;

/**
 * Class Form
 * @package ComponentLibrary\Component\Form
 */
class Form extends \ComponentLibrary\Component\BaseController implements FormInterface
{
    public function init()
    {
        extract($this->data);

        //Id always required
        if (!$id) {
            $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
        }

        //Add validation class as default
        if ($validation) {
            $this->data['classList'][] = 'js-form-validation';
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'form';
    }

    // -------------------------------------------------------------------------
    // FormInterface — generated getters
    // -------------------------------------------------------------------------

    public function getMethod(): string
    {
        return $this->data['method'] ?? 'POST';
    }

    public function getAction(): string
    {
        return $this->data['action'] ?? '#';
    }

    public function getValidation(): bool
    {
        return $this->data['validation'] ?? true;
    }

    public function getErrorMessage(): string
    {
        return $this->data['errorMessage'] ?? '';
    }

    public function getValidateMessage(): string
    {
        return $this->data['validateMessage'] ?? '';
    }
}
