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

    private function getType(string $type)
    {
        return in_array($type, ['auto', 'hint', 'manual']) ? $type : 'auto';
    }

    private function getHorizontalPlacement(?string $horizontalPlacement)
    {
        return in_array($horizontalPlacement, ['left', 'right', 'center']) ? $horizontalPlacement : 'center';
    }

    private function getVerticalPlacement(?string $verticalPlacement)
    {
        return in_array($verticalPlacement, ['top', 'center', 'bottom']) ? $verticalPlacement : 'center';
    }
}
