<?php

namespace ComponentLibrary\Component\Map;

/**
 * Class Map
 * @package ComponentLibrary\Component\Map
 */
class Map extends \ComponentLibrary\Component\BaseController implements MapInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['id'] = $this->getUid();

        $this->data['attributeList']['data-js-map-start-position'] = json_encode($startPosition);
        $this->data['attributeList']['data-js-map-markers'] = json_encode($markers ?? []);
        $this->data['attributeList']['data-js-map-style'] = $mapStyle;
        $this->data['attributeList']['data-js-map-id'] = $this->data['id'];
        $this->data['attributeList']['style'] = "position: relative; height: {$height}; width: 100%;";
        $this->data['attributeList']['data-js-map-provider'] = $provider;

        $this->data['matAttributeList'] = [];
        $this->data['mapAttributeList']['style'] = "position: unset; height: {$height}; width: 100%; background: #f0f0f0;";
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'map';
    }

    // -------------------------------------------------------------------------
    // MapInterface — generated getters
    // -------------------------------------------------------------------------

    public function getMarkers(): array
    {
        return $this->data['markers'] ?? [];
    }

    public function getStartPosition(): object
    {
        return $this->data['startPosition'] ?? (object) [];
    }

    public function getMapStyle(): string
    {
        return $this->data['mapStyle'] ?? 'default';
    }

    public function getHeight(): string
    {
        return $this->data['height'] ?? '600px';
    }

    public function getProvider(): string
    {
        return $this->data['provider'] ?? 'openstreetmap';
    }
}
