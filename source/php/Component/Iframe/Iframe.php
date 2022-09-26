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
            $src_parsed = parse_url($src);

            $embed_url = "//{$src_parsed['host']}";
            $embed_url .= isset($src_parsed['path']) ? $src_parsed['path'] : '';

            $this->data['attributeList']['data-src'] = $embed_url;

            $suppliers = $this->getSuppliers();

            if (is_array($suppliers)) {
                foreach ($suppliers as $supplier) {
                    $key = array_search($src_parsed['host'], $supplier->domain, true);

                    if (is_integer($key)) {
                        $this->data['attributeList']['data-supplier-host'] = "//{$supplier->domain[$key]}";
                        $this->data['attributeList']['data-supplier-name'] = $supplier->name;
                        if (isset($supplier->policy)) {
                            $this->data['attributeList']['data-supplier-policy'] = $supplier->policy;
                        }
                    }
                }
            }
        }
    }
    public function getSuppliers()
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

        return $suppliers;
    }
}

class Supplier
{
    public function __construct(string $name, array $domain, string $policy = '', bool $requires_accept = true)
    {
        $this->name = $name;
        $this->domain = $domain;
        $this->policy = $policy;
        $this->requires_accept = $requires_accept;
    }
}
