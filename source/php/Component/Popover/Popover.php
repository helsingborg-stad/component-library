<?php

namespace ComponentLibrary\Component\Popover;

class Popover extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass();
        $this->data['id'] = $id ?? uniqid('popover-');

        $this->data['attributeList']['popover'] = $this->getType($type);
        $this->data['attributeList']['data-popover-animation'] = $this->getAnimationType($animation);

        if ($relative) {
            $this->data['attributeList']['data-js-popover-relative'] = 'true';
        }

        if ($horizontalPlacement) {
            $this->data['attributeList']['data-js-popover-horizontal-placement'] =
                $this->getHorizontalPlacement($horizontalPlacement);
        }

        if ($verticalPlacement) {
            $this->data['attributeList']['data-js-popover-vertical-placement'] =
                $this->getVerticalPlacement($verticalPlacement);
        }

        if ($backdrop) {
            $this->data['attributeList']['data-popover-backdrop'] = 'true';
        }
    }

    private function getAnimationType(string $animation): string
    {
        return in_array($animation, ['fade', 'slide-up', 'slide-down', 'slide-left', 'slide-right']) ? $animation : 'fade';
    }

    private function getType(string $type): string
    {
        return in_array($type, ['auto', 'hint', 'manual']) ? $type : 'auto';
    }

    private function getHorizontalPlacement(?string $horizontalPlacement): string
    {
        return in_array($horizontalPlacement, ['left', 'right', 'center']) ? $horizontalPlacement : 'center';
    }

    private function getVerticalPlacement(?string $verticalPlacement): string
    {
        return in_array($verticalPlacement, ['top', 'center', 'bottom']) ? $verticalPlacement : 'center';
    }
}
