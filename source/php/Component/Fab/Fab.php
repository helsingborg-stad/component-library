<?php

namespace ComponentLibrary\Component\Fab;

/**
 * Class Fab
 * @package ComponentLibrary\Component\Fab
 */
class Fab extends \ComponentLibrary\Component\BaseController implements FabInterface
{
    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Generate panel id js support
        $this->data['panelId'] = "panel-id-" . uniqid(); 

        //Create panel trigger
        if(is_array($button) && !empty($button)) {
            $this->data['button']['attributeList'] = ['data-js-toggle-trigger' => $this->data['panelId']];

            if ($closeLabel) {
                $this->data['button']['attributeList']['data-toggle-label'] = $closeLabel;
            }

            if ($closeIcon) {
                $this->data['button']['attributeList']['data-toggle-icon'] = $closeIcon;
            }
        }

        //Position
        $this->data['classList'][] = "{$this->getBaseClass()}__{$position}";
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'fab';
    }

    // -------------------------------------------------------------------------
    // FabInterface — generated getters
    // -------------------------------------------------------------------------

    public function getPosition(): string
    {
        return $this->data['position'] ?? 'bottom-right';
    }

    public function getHeading(): string
    {
        return $this->data['heading'] ?? 'Samlade länkar för elever och föräldrar';
    }

    public function getButton(): bool
    {
        return $this->data['button'] ?? false;
    }

    public function getSlot(): string
    {
        return $this->data['slot'] ?? '';
    }

    public function getCloseLabel(): bool
    {
        return $this->data['closeLabel'] ?? false;
    }

    public function getCloseIcon(): bool
    {
        return $this->data['closeIcon'] ?? false;
    }
}
