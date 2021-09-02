<?php

namespace ComponentLibrary\Component\Fab;

/**
 * Class Fab
 * @package ComponentLibrary\Component\Fab
 */
class Fab extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Generate panel id js support
        $this->data['panelId'] = "panel-id-" . uniqid(); 

        //Create panel trigger
        if(is_array($button) && !empty($button)) {
            $this->data['button']['attributeList'] = ['js-toggle-trigger' => $this->data['panelId']];

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
}
