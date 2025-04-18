<?php

namespace ComponentLibrary\Component\Drawer;

class Drawer extends \ComponentLibrary\Component\BaseController
{
    private array $defaultScreenSizes = ['xs', 'sm'];

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Get default if undefined
        $screenSizes = $screenSizes ?? $this->defaultScreenSizes;

        //Define has data
        $this->data['searchSlotHasData'] = $this->slotHasData('search');
        $this->data['menuSlotHasData'] = $this->slotHasData('menu');
        $this->data['afterMenuSlotHasData'] = $this->slotHasData('afterMenu');

        //Create screen sizes parameters
        $this->data['screenSizeClassNames'] = $this->getScreenSizeClassNamesAsString(
            $screenSizes
        ); 
        $this->data['toggleButtonData'] = $this->getToggleButtonData(
            $toggleButtonData ?? [],
            $this->getScreenSizeClassNames($screenSizes)
        );

        $this->data['attributeList']['data-js-toggle-item'] = 'drawer-' . $this->getUid();
        $this->data['attributeList']['data-js-toggle-class'] = 'is-open';
        $this->data['moveTo'] = $this->getMoveToAttribute($this->data['attributeList']);
        $this->data['simulateClickSelector'] = "[data-js-toggle-trigger=drawer-" . $this->getUid() . "]";
    
    }

    private function getMoveToAttribute(array $attributeList): string
    {
        $moveToValue = $attributeList['data-move-to'] ?? '';

        if (empty($attributeList['data-move-to'])) return '';

        return "data-move-to=\"$moveToValue\"";
    }

    /**
     * Get screen size class names as array
     * 
     * @param array|null $screenSizes
     * @return array
     */
    private function getScreenSizeClassNames($screenSizes): array
    {
        $classNames = [];
        $availableScreenSizes = ['xs', 'sm', 'md', 'lg', 'xl'];

        foreach ($availableScreenSizes as $availableScreenSize) {
            if (!in_array($availableScreenSize, $screenSizes)) {
                $classNames[] = 'u-display--none@' . $availableScreenSize;
            }
        }
        
        return $classNames;
    }


    /**
     * Get screen size class names as string
     * 
     * @param array|null $screenSizes
     * @return string
     */
    private function getScreenSizeClassNamesAsString($screenSizes): string {

        $classNames = $this->getScreenSizeClassNames($screenSizes); 

        if(!empty($classNames) && is_array($classNames)) {
            return implode(" ", $classNames); 
        }
        return "";
    }

    private function getToggleButtonData($toggleButtonData, array $screenSizeClassNames)
    {
        //Nothing to process
        if (empty($toggleButtonData)) {
            return null;
        } 

        $toggleButtonData['attributeList']['data-js-toggle-trigger'] = 'drawer-' . $this->getUid();
        $toggleButtonData['attributeList']['aria-controls'] = 'drawer';
        $toggleButtonData['classList'] = array_merge($screenSizeClassNames, $toggleButtonData['classList'] ?? []);
        $toggleButtonData['classList'][] = $this->getBaseClass('toggle');

        return $toggleButtonData;
    }
}
