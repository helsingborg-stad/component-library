<?php

namespace ComponentLibrary\Helper;

class Truncate {
    public static function truncate(string $content, int $length, string $suffix = '…'): string
    {
        if (strlen($content) <= $length) {
            return $content;
        }

        if (function_exists('mb_substr')) {
            return mb_substr($content, 0, $length) . $suffix;
        }

        return substr($content, 0, $length) . $suffix;
    }
}
