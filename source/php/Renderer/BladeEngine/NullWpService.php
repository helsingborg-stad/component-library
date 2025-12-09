<?php

namespace ComponentLibrary\Renderer\BladeEngine;

use WpService\Contracts\ApplyFilters;

/**
 * A null implementation of the ApplyFilters interface for environments without WordPress.
 */
class NullWpService implements ApplyFilters {
    public function applyFilters(string $hookName, mixed $value, mixed ...$args): mixed
    {
        return $value;
    }
}