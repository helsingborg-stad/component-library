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

                foreach ($suppliers as $supplier) {
                    foreach ($supplier->domains as $domain) {
                        echo '<pre>' . print_r($domain, true) . '</pre>';
                        if ($src_url['host'] == $domain_url) {
                            $this->data['attributeList']['data-supplier']['host'] = $domain_url;
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
                array( 'maps.google.com', 'google.com/maps', 'www.google.com/maps'),
                true,
                'https://policies.google.com/privacy?hl=en-US'
            ),
            new Supplier(
                'YouTube',
                array( 'youtube.com', 'www.youtube.com' ),
                true,
                'https://policies.google.com/privacy?hl=en-US'
            ),
            new Supplier(
                'Helsingborg Stad',
                array( 'helsingborg.se', 'www.helsingborg.se'),
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
