<?php

namespace ComponentLibrary\Component\Drawer;

class Drawer extends \ComponentLibrary\Component\BaseController
{
    private array $defaultScreenSizes = ['xs', 'sm'];

    public function init()
    {
     //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['searchSlotHasData'] = $this->slotHasData('search');
        $this->data['menuSlotHasData'] = $this->slotHasData('menu');
        $this->data['screenSizeClassNames'] = $this->getScreenSizeClassNames($screenSizes);

    /**
     * Get screen size class names
     * 
     * @param array|null $screenSizes
     * @return string
     */
    private function getScreenSizeClassNames($screenSizes):string {
        $classNames = [];
        $screenSizes = $screenSizes ?? $this->defaultScreenSizes;
        $availableScreenSizes = ['xs', 'sm', 'md', 'lg', 'xl'];

        foreach($availableScreenSizes as $availableScreenSize) {
            if( !in_array($availableScreenSize, $screenSizes) ) {
                $classNames[] = 'u-display--none@' . $availableScreenSize;
            }
        }

        return implode(' ', $classNames);
    }
    }
}
