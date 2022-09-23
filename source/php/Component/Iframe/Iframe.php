<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        if ($width) {
            $this->data['attributeList']['width'] = $width;
        }

        if ($height) {
            $this->data['attributeList']['height'] = $height;
        }

        if ($frameborder) {
            $this->data['attributeList']['frameborder'] = $frameborder;
        }

        if (isset($options)) {
            $this->data['attributeList']['options'] = $options;
        }
        if ($loading) {
            $this->data['attributeList']['loading'] = $loading;
        }

        $this->data['attributeList']['src'] = "about:blank";

        if ($src) {
            $this->data['attributeList']['data-src'] = $src;

            $suppliers = $this->getSuppliers();

            if (is_array($suppliers)) {
                $src_parsed = parse_url($src);

                foreach ($suppliers as $supplier) {
                    $key = array_search($src_parsed['host'], $supplier->domain, true);

                    if (is_integer($key)) {
                        $this->data['attributeList']['data-supplier-host'] = $supplier->domain[$key];
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
