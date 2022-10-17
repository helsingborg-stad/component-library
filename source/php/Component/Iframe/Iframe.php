<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        $this->data['classList'][] = 'js-suppressed-iframe';

        $this->data['attributeList']['options'] = $options;
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

        if(isset($embedVideo)) {
            $this->data['wrapperClasses'] = $embedVideo;
        } else {
            $this->data['wrapperClasses'] = false;
        }
        
        if (isset($this->data['options'])) {
            $json = json_decode($this->data['options']);

            if (isset($this->data['attributeList']['data-supplier-policy'])) {
                $json->knownLabels->info = str_replace(
                    array('{SUPPLIER_WEBSITE}', '{SUPPLIER_POLICY}'),
                    array($this->data['attributeList']['data-supplier-name'], $this->data['attributeList']['data-supplier-policy']),
                    $json->knownLabels->info
                );
 
                $this->data['labels'] = $json->knownLabels;
            } else {
                $json->unknownLabels->info = str_replace(
                    '{SUPPLIER_WEBSITE}',
                    $this->data['attributeList']['data-supplier-host'],
                    $json->unknownLabels->info
                );
                $this->data['labels'] = $json->unknownLabels;
            }
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
                array( 'vimeo.com', 'www.vimeo.com', 'player.vimeo.com' ),
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
                array( 'kommersannons.se', 'www.kommersannons.se' ),
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
        $host = strtolower($srcParsed['host']);

        if (is_array($suppliers)) {
            foreach ($suppliers as $supplier) {
                $key = array_search($host, $supplier->domain, true);
                $this->data['attributeList']['data-supplier-host'] = $supplier->domain[$key];

                if (is_integer($key)) {
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

        $ytParams = 'autoplay=0&showinfo=0&rel=0';

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
        $embedUrl = $scheme . '://' . strtolower($srcParsed['host']);

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
