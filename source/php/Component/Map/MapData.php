<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Map;

final class MapData
{
    public function __construct(
        public float|int $lat = 56.046467,
        public float|int $lng = 12.694512,
        public int $zoom = 11,
        public string $mapStyle = 'default',
        public string $height = '600px',
        public array $markers = [],
        public string $provider = 'openstreetmap',
    ) {}
}
