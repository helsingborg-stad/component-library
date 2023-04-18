<?php

namespace ComponentLibrary\Component\OpenStreetMap;

/**
 * Class OpenStreetMap
 * @package ComponentLibrary\Component\OpenStreetMap
 */
class OpenStreetMap extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['sidebarContentHasData'] = $this->slotHasData('sidebarContent');

        if (!empty($pins)) {
            $this->data['attributeList']['js-map-pin-data'] = $pins;
        }

        if (!empty($startPosition)) {
            $this->data['attributeList']['js-map-start-position'] = $startPosition;
        }

        if (!empty($mapStyle)) {
            $this->data['attributeList']['js-map-style'] = $mapStyle;
        }

        if (!empty($title)) {
            $this->data['title'] = $title;
        }

        $this->data['attributeList']['data-js-toggle-item'] = "expand";
        $this->data['attributeList']['data-js-toggle-class'] = "is-expanded";
        $this->data['attributeList']['id'] = "openstreetmap";
    }
}
