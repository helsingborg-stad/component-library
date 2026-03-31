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

        //Check if slot has data
        $this->data['slotHasData'] = $this->slotHasData('slot');

        //Create panel trigger
        if(is_array($button) && !empty($button)) {

            // Only add data trigger, if there are a slot to toggle
            if($this->data['slotHasData'] === false) {
                $this->data['button']['attributeList'] = ['data-js-toggle-trigger' => $this->data['panelId']];
            }

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
