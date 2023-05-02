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

        $this->data['id'] = $this->getUid();

        if (!empty($pins)) {
            $this->data['attributeList']['js-map-pin-data'] = json_encode($pins, JSON_UNESCAPED_UNICODE);
        }

        $this->data['attributeList']['js-map-start-position'] = 
        json_encode(
            !empty($startPosition) ? $startPosition : [ 
                'lat'  => '56.046029',
                'lng'  => '12.693904',
                'zoom' => 14
        ]);

        if (!empty($mapStyle)) {
            $this->data['attributeList']['js-map-style'] = $mapStyle;
        }

        if (!empty($title)) {
            $this->data['title'] = $title;
        }

        if (!empty($containerAware)) {
            $this->data['classList'][] = $this->getBaseClass('size-sm', true);
        }

        if (!empty($fullWidth)) {
            $this->data['classList'][] = $this->getBaseClass('full-width', true);
        }

        if ($this->data['sidebarContentHasData']) {
            $this->data['classList'][] = $this->getBaseClass('sidebar', true);
        }

        $this->data['attributeList']['data-js-toggle-item'] = "expand";
        $this->data['attributeList']['data-js-toggle-class'] = "is-expanded";
        $this->data['attributeList']['data-js-map-id'] = $this->data['id'];
    }
}
