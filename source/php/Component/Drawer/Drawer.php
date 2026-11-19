<?php

namespace ComponentLibrary\Component\Drawer;

class Drawer extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        $this->data['id'] = 'drawer-' . (!empty($id) ? $id : $this->getUid());

        //Define has data
        $this->data['searchSlotHasData'] = $this->slotHasData('search');
        $this->data['menuSlotHasData'] = $this->slotHasData('menu');
        $this->data['afterMenuSlotHasData'] = $this->slotHasData('afterMenu');
        $this->data['toggleButtonData'] = $this->getToggleButtonData($toggleButtonData);
        $this->data['classList'][] = $this->getBaseClass();
    }

    private function getToggleButtonData(mixed $toggleButtonData)
    {
        //Nothing to process
        if (empty($toggleButtonData) || !is_array($toggleButtonData)) {
            return null;
        }

        $toggleButtonData['attributeList']['aria-controls'] = $this->data['id'];
        $toggleButtonData['attributeList']['popovertarget'] = $this->data['id'];
        $toggleButtonData['classList'][] = $this->getBaseClass('toggle');

        return $toggleButtonData;
    }
}
