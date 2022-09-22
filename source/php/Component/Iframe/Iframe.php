<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        extract($this->data);

        $suppliers = $this->getSuppliers();
        $supplierUrl = parse_url('https:' . $this->data['src']);

        foreach($suppliers as $supplier) {
            if($supplier->domain == $supplierUrl['host']) {

                $this->data['supplier'] = $supplier->domain;
                $this->data['policy'] = $supplier->policy;

            }
        }
		
		if($src) {
            $this->data['attributeList']['data-src'] = $src;
        }
        $this->data['classList'][] = $this->getBaseClass();
	}

       public function getSuppliers()
    {
        $suppliers = array(
            new Supplier(
            'Hej',
            'https://policies.google.com/privacy?hl=en-US'
            ),
            new Supplier(
            'fr.wikipedia.org',
            'https://policies.google.com/privacy?hl=en-US'
            ),
         
        );

        return $suppliers;
    }
}

class Supplier
{
    public function __construct(string $domain, string $policy = '')
    {
        $this->domain = $domain;
        $this->policy = $policy;
    }
}