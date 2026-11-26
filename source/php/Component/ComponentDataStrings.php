<?php

namespace ComponentLibrary\Component;

/** Converts component data between its list and HTML string forms. */
final class ComponentDataStrings
{
    /**
     * Split class entries into unique tokens, preserving their first occurrence.
     *
     * @param array $classes Class names or whitespace-separated groups of names.
     * @return array Unique class names.
     */
    public static function classes(array $classes): array
    {
        $tokens = [];
        foreach ($classes as $class) {
            foreach (preg_split('/\s+/', trim((string) $class), -1, PREG_SPLIT_NO_EMPTY) as $token) {
                $tokens[$token] = $token;
            }
        }
        return array_values($tokens);
    }

    /**
     * Parse a class string into unique class names.
     *
     * @param string $classes Whitespace-separated class names.
     * @return array Unique class names.
     */
    public static function parseClasses(string $classes): array
    {
        return self::classes([$classes]);
    }

    /**
     * Remove duplicate attribute names, ignoring case and keeping the first value.
     *
     * @param array $attributes Attribute names mapped to their values.
     * @return array Attributes with unique names.
     */
    public static function attributes(array $attributes): array
    {
        $result = [];
        $names = [];
        foreach ($attributes as $name => $value) {
            $normalized = strtolower((string) $name);
            if (!isset($names[$normalized])) {
                $names[$normalized] = true;
                $result[$name] = $value;
            }
        }
        return $result;
    }

    /**
     * Parse an HTML attribute string, decoding values and keeping the first name.
     *
     * @param string $attributes HTML attributes with quoted or unquoted values.
     * @return array Attribute names mapped to decoded values.
     */
    public static function parseAttributes(string $attributes): array
    {
        $result = [];
        $names = [];
        preg_match_all('/([^\s=\/< >"\']+)(?:\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s>]+)))?/', $attributes, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $value = $match[2] ?? '';
            if (isset($match[3]) && $match[3] !== '') {
                $value = $match[3];
            } elseif (isset($match[4])) {
                $value = $match[4];
            }
            // HTML treats attribute names as case-insensitive and keeps the first.
            $name = strtolower($match[1]);
            if (!isset($names[$name])) {
                $names[$name] = true;
                $result[$match[1]] = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        }
        return $result;
    }
}
