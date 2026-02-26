<?php

namespace ComponentLibrary\Component\Logotype;

class Logotype extends \ComponentLibrary\Component\BaseController implements LogotypeInterface
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add placeholder class
        if(!$src) {
            $this->data['classList'][] = $this->getBaseClass() . "--is-placeholder";
        }

        //Inherit the alt text
        if(!$alt && $caption) {
            $this->data['alt'] = $this->data['caption'];
        }

        //Has ripple
        if($hasRipple) {
            $this->data['classList'][] = "ripple"; 
            $this->data['classList'][] = "ripple--before"; 
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'logotype';
    }

    // -------------------------------------------------------------------------
    // LogotypeInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSrc(): bool
    {
        return $this->data['src'] ?? false;
    }

    public function getAlt(): string
    {
        return $this->data['alt'] ?? '';
    }

    public function getCaption(): string
    {
        return $this->data['caption'] ?? '';
    }

    public function getTitle(): string
    {
        return $this->data['title'] ?? '';
    }

    public function getPlaceholderText(): string
    {
        return $this->data['placeholderText'] ?? 'Image missing';
    }

    public function getHasRipple(): bool
    {
        return $this->data['hasRipple'] ?? true;
    }
}
