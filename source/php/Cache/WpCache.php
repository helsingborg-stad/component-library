<?php

namespace ComponentLibrary\Cache;

class WpCache implements CacheInterface {
    public function __construct(){}

    public function get(string $key, ?string $group = null): mixed {
        return wp_cache_get($key, $group);
    }

    public function set(string $key, mixed $data, ?string $group = null): void {
        wp_cache_set($key, $data, $group ?? "");
    }
}
