<?php
namespace ComponentLibrary\Helper;

class URL
{
    /**
     * > If the URL starts with `http://` or `//`, replace `http://` with `https://`. If the URL starts
     * with `//`, prepend `https://`
     *
     * @param string url The URL to normalize
     * @param bool forceHttps If true, the function will force the URL to be https.
     */
    public static function normalizeUrl(string $url, bool $forceHttps = true)
    {
        if ($forceHttps && (str_starts_with($url, 'http://') || str_starts_with($url, '//'))) {
            return str_replace('http://', 'https://', $url);
        }
        
        if (str_starts_with($url, '//')) {
            return 'https://' . $url;
        }

        return $url;
    }
}
