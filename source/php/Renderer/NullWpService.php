<?php

namespace ComponentLibrary\Renderer;

/**
 * A null implementation of the ApplyFilters interface for environments without WordPress.
 */
class NullWpService implements \WpService\Contracts\WpCacheGet, \WpService\Contracts\WpCacheSet, \WpService\Contracts\ApplyFilters
{
    public function wpCacheGet(int|string $key, string $group = '', bool $force = false, null|bool &$found = null): mixed
    {
        return false;
    }

    public function wpCacheSet(int|string $key, mixed $data, string $group = '', int $expire = 0): bool
    {
        return false;
    }

    public function applyFilters(string $hookName, mixed $value, mixed ...$args): mixed
    {
        return $value;
    }
}
