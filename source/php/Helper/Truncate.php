<?php

namespace ComponentLibrary\Helper;

class Truncate {
    public static function truncate(string $content, int $length, string $suffix = '…'): string
    {
        if (strlen($content) <= $length) {
            return $content;
        }

        return substr($content, 0, $length) . $suffix;
    }
}