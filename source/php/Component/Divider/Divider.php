<?php

namespace ComponentLibrary\Component\Divider;

/**
 * Class Dropdown
 * @package ComponentLibrary\Component\Dropdown
 */
class Divider extends \ComponentLibrary\Component\BaseController implements DividerInterface
{

    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if($style) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $style;
        }

        if($size) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $size;
        }

        if($align) {
            $this->data['classList'][] = $this->getBaseClass() . '--align-' . $align;
        }

        if($frame) {
            $this->data['classList'][] = $this->getBaseClass() . '--has-frame';
        }

        if($customFont) {
            $this->data['classList'][] = $this->getBaseClass() . '--custom-font';
        }

        if(empty($title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--without-title';
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'divider';
    }

    // -------------------------------------------------------------------------
    // DividerInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getStyle(): string
    {
        return $this->data['style'] ?? 'dashed';
    }

    public function getSize(): string
    {
        return $this->data['size'] ?? 'md';
    }

    public function getTitle(): string
    {
        return $this->data['title'] ?? '';
    }

    public function getTitleVariant(): string
    {
        return $this->data['titleVariant'] ?? 'h2';
    }

    public function getAlign(): string
    {
        return $this->data['align'] ?? 'center';
    }

    public function getFrame(): bool
    {
        return $this->data['frame'] ?? true;
    }

    public function getCustomFont(): bool
    {
        return $this->data['customFont'] ?? false;
    }
}
