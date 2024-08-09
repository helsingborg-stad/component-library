<?php

namespace ComponentLibrary\Cache;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Cache\WpCache;

Class TrySetWpCache implements CacheInterface
{    
    public function __construct(private CacheInterface $cache) {
        if (function_exists('wp_cache_set')) {
            $this->cache = new WpCache();
        }

        return $this->cache;
    }

    public function set(string $key, mixed $data, ?string $group = null): void {
        $this->cache->set($key, $data, $group);
    }

    public function get(string $key, ?string $group = null): mixed {
        return $this->cache->get($key, $group);
    }
}