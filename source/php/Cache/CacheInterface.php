<?php

namespace ComponentLibrary\Cache;

interface CacheInterface {
    public function get(string $key, ?string $group = null): mixed;
    public function set(string $key, mixed $data, ?string $group = null): void;
}