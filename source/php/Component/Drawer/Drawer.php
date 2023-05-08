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
        $this->data['screenSizeClassNames'] = $this->getScreenSizeClassNames($screenSizes ?? $this->defaultScreenSizes);
        $this->data['toggleButtonData'] = $this->getToggleButtonData($toggleButtonData ?? [], $this->data['screenSizeClassNames']);
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
     * Get screen size class names
     * 
     * @param array|null $screenSizes
     * @return string
     */
    private function getScreenSizeClassNames($screenSizes): string
    {
        $classNames = [];
        $availableScreenSizes = ['xs', 'sm', 'md', 'lg'];

        foreach ($availableScreenSizes as $availableScreenSize) {
            if (!in_array($availableScreenSize, $screenSizes)) {
                $classNames[] = 'u-display--none@' . $availableScreenSize;
            }
        }

        return implode(' ', $classNames);
    }

    private function getToggleButtonData($toggleButtonData, string $screenSizeClassNames)
    {

        if (empty($toggleButtonData)) return null;

        $toggleButtonData['attributeList']['data-js-toggle-trigger'] = 'drawer-' . $this->getUid();
        $toggleButtonData['attributeList']['aria-controls'] = 'navigation';
        $toggleButtonData['classList'] = explode(' ', $screenSizeClassNames);

        return $toggleButtonData;
    }
}
