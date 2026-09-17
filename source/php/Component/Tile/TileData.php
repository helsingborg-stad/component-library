<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tile;

final class TileData
{
    public function __construct(
        public string $width = '',
        public string $height = '',
        public string $backgroundImage = '',
    ) {}
}
