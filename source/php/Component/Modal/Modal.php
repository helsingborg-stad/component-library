<?php

namespace ComponentLibrary\Component\Modal;

class Modal extends \ComponentLibrary\Component\BaseController implements ModalInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Panel
        if ($isPanel) {
            $this->data['classList'][] = $this->getBaseClass() . "--is-panel";
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--is-modal";
        }

        if ($animation) {
            $this->data['classList'][] = $this->getBaseClass($animation, true);
        }

        //The size
        if ($size && in_array($size, ['sm', 'md', 'lg'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--size-" . $size;
        }

        //Padding
        if ($padding && in_array($padding, range(0, 4))) {
            $this->data['classList'][] = $this->getBaseClass() . "--padding-" . $padding;
        }

        //Border radius
        if ($borderRadius && in_array($borderRadius, ['sm', 'md', 'lg'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--border-radius-" . $borderRadius;
        }

        if (isset($ariaLabels)) {
            $this->data['ariaLabels'] = $ariaLabels;
        }

        if ($transparent) {
            $this->data['classList'][] = $this->getBaseClass() . "--transparent";
        }

        //Overlay
        $this->data['classList'][] = $this->getBaseClass() . "--overlay-" . $overlay;

        //Set dialog attributes
        $this->data['attributeList']['aria-modal'] = 'true';
        $this->data['attributeList']['role'] = 'dialog';
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'modal';
    }

    // -------------------------------------------------------------------------
    // ModalInterface — generated getters
    // -------------------------------------------------------------------------

    public function getHeading(): string
    {
        return $this->data['heading'] ?? '';
    }

    public function getSlot(): string
    {
        return $this->data['slot'] ?? '';
    }

    public function getBottom(): string
    {
        return $this->data['bottom'] ?? '';
    }

    public function getOverlay(): string
    {
        return $this->data['overlay'] ?? 'light';
    }

    public function getIsPanel(): bool
    {
        return $this->data['isPanel'] ?? false;
    }

    public function getId(): string
    {
        return $this->data['id'] ?? '';
    }

    public function getAnimation(): string
    {
        return $this->data['animation'] ?? 'slide-up';
    }

    public function getNavigation(): bool
    {
        return $this->data['navigation'] ?? false;
    }

    public function getSize(): string
    {
        return $this->data['size'] ?? '';
    }

    public function getPadding(): int
    {
        return $this->data['padding'] ?? 3;
    }

    public function getBorderRadius(): bool
    {
        return $this->data['borderRadius'] ?? false;
    }

    public function getTransparent(): bool
    {
        return $this->data['transparent'] ?? false;
    }

    public function getCloseButtonText(): string
    {
        return $this->data['closeButtonText'] ?? '';
    }
}
