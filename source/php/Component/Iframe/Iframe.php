<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        if ($src) {
            $this->data['attributeList']['data-src'] = $src;

            $suppliers = $this->getSuppliers();

            if (is_array($suppliers)) {
                $src_parsed = parse_url($src);
                // TODO extract just the host domain without any sub domains from src and $supplier->host to make sure we're matching as broadly as possible
                foreach ($suppliers as $supplier) {
                    if ($src_parsed['host'] == $supplier->domain) {
                        $this->data['attributeList']['data-supplier'] = $supplier->domain;
                        if ((bool) $supplier->policy) {
                            $this->data['attributeList']['data-policy'] = $supplier->policy;
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
                'Google Maps',
                'google.com',
                'https://policies.google.com/privacy'
            ),
            new Supplier(
                'YouTube',
                'youtube.com',
                'https://policies.google.com/privacy'
            ),
            new Supplier(
                'YouTube',
                'youtu.be',
                'https://policies.google.com/privacy'
            ),
            new Supplier(
                'Helsingborg Stad',
                'helsingborg.se',
                'https://helsingborg.se/om-webbplatsen/sa-har-behandlar-vi-dina-personuppgifter/'
            ),
        );

        return $suppliers;
    }
}

class Supplier
{
    public function __construct(string $name, string $domain, string $policy = '', bool $requires_accept = true)
    {
        $this->name = $name;
        $this->domain = $domain;
        $this->policy = $policy;
        $this->requires_accept = $requires_accept;
    }
}
