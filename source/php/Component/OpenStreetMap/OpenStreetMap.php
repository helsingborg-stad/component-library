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
         foreach ($pins as &$pin) {
            $pin['lat'] = strval($pin['lat']);
            $pin['lng'] = strval($pin['lng']);
        }
            $this->data['attributeList']['data-js-map-pin-data'] = json_encode($pins, JSON_UNESCAPED_UNICODE);

        }

        if (
            empty($startPosition)
            && !empty($mapStartZoom)
            && ( is_string($mapStartLatLng) && !empty($mapStartLatLng) )
        ) {
            $mapStartLatLng = explode(',', $mapStartLatLng);
            $startPosition = [
                'lat'  => trim($mapStartLatLng[0]),
                'lng'  => trim($mapStartLatLng[1]),
                'zoom' => (int) $mapStartZoom
            ];
        } elseif (empty($startPosition)) {
            $startPosition = [
                'lat' => '59.3293235',
                'lng' => '18.0685808',
                'zoom' => '14',
            ];
        }
        $this->data['attributeList']['data-js-map-start-position'] = json_encode($startPosition);

        if (!empty($mapStyle)) {
            $this->data['attributeList']['data-js-map-style'] = $mapStyle;
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

        if (!empty($expanded)) {
            $this->data['classList'][] = 'is-expanded';
        }

        $this->data['attributeList']['data-js-toggle-item'] = "expand";
        $this->data['attributeList']['data-js-toggle-class'] = "is-expanded";
        $this->data['attributeList']['data-js-map-id'] = $this->data['id'];
    }
}
