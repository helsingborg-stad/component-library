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
                $src_url = parse_url($src);

                // echo '<pre>' . print_r($src, true) . '</pre>';

                foreach ($suppliers as $supplier) {
                    foreach ($supplier->domains as $domain) {
                        if ($src_url['host'] == $domain) {
                            $this->data['attributeList']['data-supplier-host'] = $domain;
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
                true,
                'https://policies.google.com/privacy?hl=en-US'
            ),
            new Supplier(
                'YouTube',
                'youtube.com',
                true,
                'https://policies.google.com/privacy?hl=en-US'
            ),
            new Supplier(
                'YouTube',
                'youtu.be',
                true,
                'https://policies.google.com/privacy?hl=en-US'
            ),
            new Supplier(
                'Helsingborg Stad',
                'helsingborg.se',
                true,
            ),
        );

        return $suppliers;
    }
}

class Supplier
{
    public function __construct(string $name, array $domains, bool $requires_accept = true, string $policy_document = '')
    {
        $this->name = $name;
        $this->domains = $domains;
        $this->requires_accept = $requires_accept;
        $this->policy_document = $policy_document;
    }
}
