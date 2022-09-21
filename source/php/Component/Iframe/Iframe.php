<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {

        extract($this->data);

      /*   $json = json_decode('[{"supplier": "fr.wikipedia.org", "url": "https://meta.wikimedia.org/wiki/Privacy_policy/sv"}, {"supplier": "https://www.google.se/maps", "url": "https://support.google.com/maps/answer/7576020?hl=sv#null"}]'); */

        $suppliers = $this->getSuppliers();

        $supplierUrl = parse_url('https:' . $this->data['src']);

        //print_r($suppliers[0]->domain);

        foreach($suppliers as $supplier) {
            if($supplier->domain == $supplierUrl['host']) {
                var_dump($supplier->domain);
                //print_r($supplier->supplier);
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
            'www.google.com',
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