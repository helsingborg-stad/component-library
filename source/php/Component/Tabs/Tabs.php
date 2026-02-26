<?php

namespace ComponentLibrary\Component\Tabs;

class Tabs extends \ComponentLibrary\Component\BaseController implements TabsInterface
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        // Generate unique ID
        $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'tabs';
    }

    // -------------------------------------------------------------------------
    // TabsInterface — generated getters
    // -------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->data['id'] ?? '';
    }

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getTabs(): array
    {
        return $this->data['tabs'] ?? [];
    }

    public function getHeadingElement(): string
    {
        return $this->data['headingElement'] ?? 'button';
    }

    public function getContentElement(): string
    {
        return $this->data['contentElement'] ?? 'div';
    }
}
