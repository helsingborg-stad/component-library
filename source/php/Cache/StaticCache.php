<?php

namespace ComponentLibrary\Cache;

class StaticCache implements CacheInterface {

    private static $cache = [];

    public function __construct() {}

    public function get(string $key, ?string $group = null): mixed {
        if ($group && isset(self::$cache[$group][$key])) {
            return self::$cache[$group][$key];
        }

        if ($key && isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        return null;
    }

    public function set(string $key, mixed $data, ?string $group = null): void {
        if ($group) {
            self::$cache[$group] = self::$cache[$group] ?? [];
            self::$cache[$group][$key] = $data;

            return;
        }

        if ($key) {
            self::$cache[$key] = $data;
        }
    }
}
