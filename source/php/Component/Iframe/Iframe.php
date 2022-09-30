<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        $this->data['classList'][] = 'js-suppressed-iframe';

        if (isset($width)) {
            $this->data['attributeList']['width'] = $width;
        }

        if (isset($height)) {
            $this->data['attributeList']['height'] = $height;
        }

        if (isset($frameborder)) {
            $this->data['attributeList']['frameborder'] = $frameborder;
        }

        if (isset($loading)) {
            $this->data['attributeList']['loading'] = $loading;
        }

        $this->data['attributeList']['src'] = "about:blank";

        if (isset($src)) {
            $this->data['attributeList']['data-src'] = $this->buildEmbedUrl($src);
            $this->data = $this->setSupplierDataAttributes($src, $this->data);
        }
    }
    public static function getSuppliers()
    {
        $suppliers = array(
            new Supplier(
                'Google',
                array( 'google.com', 'maps.google.com', 'google.se', 'maps.google.se' ),
                'https://policies.google.com/privacy'
            ),
            new Supplier(
                'YouTube',
                array( 'youtube.com', 'www.youtube.com', 'youtu.be' ),
                'https://policies.google.com/privacy'
            ),
            new Supplier(
                'Vimeo',
                array( 'vimeo.com', 'www.vimeo.com' ),
                'https://vimeo.com/privacy'
            ),
            new Supplier(
                'Helsingborg Stad',
                array( 'helsingborg.se', 'www.helsingborg.se' ),
                'https://helsingborg.se/om-webbplatsen/sa-har-behandlar-vi-dina-personuppgifter/'
            ),
            new Supplier(
                'Mynewsdesk',
                array( 'helsingborg.mynewsdesk.com', 'mynewsdesk.com' ),
                'https://www.mynewsdesk.com/se/about/terms-and-conditions/'
            ),
            new Supplier(
                'KommersAnnons.se',
                array( 'kommersannons.se' ),
                'https://kommersannons.se/'
            ),

        );

        if (function_exists('apply_filters')) {
            return apply_filters(__NAMESPACE__ . '\\' . ucfirst(__FUNCTION__), $suppliers);
        }

        return $suppliers;
    }
    private function setSupplierDataAttributes(string $src, array $data)
    {
        $this->data = $data;
        $suppliers = $this::getSuppliers();

        $srcParsed = parse_url($src);

        if (is_array($suppliers)) {
            foreach ($suppliers as $supplier) {
                $key = array_search($srcParsed['host'], $supplier->domain, true);

                if (is_integer($key)) {
                    $this->data['attributeList']['data-supplier-host'] = $supplier->domain[$key];
                    $this->data['attributeList']['data-supplier-name'] = $supplier->name;
                    if (isset($supplier->policy)) {
                        $this->data['attributeList']['data-supplier-policy'] = $supplier->policy;
                    }
                }
            }
        }

        return $this->data;
    }
    private function buildEmbedUrl($src)
    {
        $srcParsed = parse_url($src);

        $ytParams = '?autoplay=0&autohide=1&cc_load_policy=0&enablejsapi=1&modestbranding=1&showinfo=0&autohide=1&iv_load_policy=3&rel=0';

        switch ($srcParsed['host']) {
            case 'youtube.com':
            case 'www.youtube.com':
                /* Replacing the path with /embed/ and then adding the v query parameter to the path and removing the v parameter from the query string. */
                $srcParsed['host'] = 'youtube.com';
                $srcParsed['path'] = '/embed/';

                if (isset($srcParsed['query'])) {
                    parse_str($srcParsed['query'], $query);
                    if (isset($query['v'])) {
                        $srcParsed['path'] .= $query['v'];
                        $srcParsed['query'] = $ytParams;
                    }
                }
                break;
            case 'youtu.be':
                $srcParsed['host'] = 'youtube.com';
                if (isset($srcParsed['path'])) {
                    $srcParsed['path'] = '/embed/' . $srcParsed['path'];
                    $srcParsed['query'] = $ytParams;
                }
                break;
            case 'vimeo.com':
            case 'www.vimeo.com':
                $srcParsed['host'] = 'player.vimeo.com';
                if (isset($srcParsed['path'])) {
                    $srcParsed['path'] = '/video' . $srcParsed['path'];
                }
                break;
            default:
                break;
        }

        $scheme = $srcParsed['scheme'] ?? 'https';
        $embedUrl = $scheme . '://' . $srcParsed['host'];

        if (isset($srcParsed['path'])) {
            $embedUrl .= $srcParsed['path'];
        }
        if (isset($srcParsed['query'])) {
            $embedUrl .= '?' . $srcParsed['query'];
        }

        return $embedUrl;
    }
}

class Supplier
{
    public function __construct(string $name, array $domain, string $policy = '', bool $requiresAccept = true)
    {
        $this->name = $name;
        $this->domain = $domain;
        $this->policy = $policy;
        $this->requiresAccept = $requiresAccept;
    }
}
