<?php

namespace ComponentLibrary\Component\Acceptance;

class Acceptance extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        $this->data['isVideo'] = false;
        $this->data['requiresAccept'] = true;

        $this->data['classList'][] = 'js-suppressed-content';
        
        if (!empty($modifier)) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $modifier;
            $this->data['classList'][] =  'js-suppressed-content--' . $modifier;
            $this->data['isVideo'] = $modifier == 'video' ? true : false;
        } else {
            $this->data['classList'][] = 'js-suppressed-content' . '--none';
        }

        if (isset($icon)) {
            $this->data['icon'] = $icon;
        }

        if (isset($height)) {
            $this->data['attributeList']['style'] = "height:" . $height . "px;";
        }

        if (!empty($src)) {
            $this->data['attributeList']['data-src'] = $src;
            $this->data = $this->setSupplierDataAttributes($src, $this->data);
        }
        
        if (isset($name)) {
            $this->data['attributeList']['data-supplier-name'] = $name;
        }
        if (isset($policy)) {
            $this->data['attributeList']['data-supplier-policy'] = $policy;
        }
        if (isset($host)) {
            $this->data['attributeList']['data-supplier-host'] = $host;
        }

        if (!empty($this->data['labels'])) {
            $json = json_decode($this->data['labels']);
            
            if(isset($json->infoLabel)) {
                $this->data['infoLabel'] = $json->infoLabel;
            }

            if (!empty($this->data['supplierPolicy'])) {
                $json->knownLabels->info = str_replace(
                    array('{SUPPLIER_WEBSITE}', '{SUPPLIER_POLICY}'),
                    array($this->data['supplierName'], $this->data['supplierPolicy']),
                    $json->knownLabels->info
                );

                $this->data['labels'] = $json->knownLabels;
            } else {
                $json->unknownLabels->info = str_replace(
                    '{SUPPLIER_WEBSITE}',
                    $this->data['supplierHost'],
                    $json->unknownLabels->info
                );
                $this->data['labels'] = $json->unknownLabels;
            }
        }
    }


    /**
     * Get suppliers
     * Creates a list of suppliers with
     * their hostnames, and policy documents.
     *
     * @return array
     */
    public function getSuppliers()
    {
        $suppliers = array(
            new Supplier(
                'Google',
                array( 'google.com', 'www.google.com', 'maps.google.com', 'google.se', 'www.google.se', 'maps.google.se' ),
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
                array( 'helsingborg.se', 'www.helsingborg.se', 'driftinfo.helsingborg.se', 'it.helsingborg.se' ),
                'https://helsingborg.se/om-webbplatsen/sa-har-behandlar-vi-dina-personuppgifter/',
                false
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
            return apply_filters($this->createFilterName($this) . '/' . ucfirst(__FUNCTION__), $suppliers);
        }

        return $suppliers;
    }

    /**
     * Set supplier data attributes
     *
     * @param string $src
     * @param array $data
     * @return array
     */
    private function setSupplierDataAttributes(string $src, array $data)
    {
        $this->data = $data;
        $suppliers  = $this->getSuppliers();

        $srcParsed = parse_url($src);
        $host = strtolower($srcParsed['host']);
        
        if (is_iterable($suppliers)) {
            foreach ($suppliers as $supplier) {
                $key = array_search($host, $supplier->domain, true);
                
                if (is_integer($key)) {
                    $this->data['supplierHost'] = $supplier->domain[$key];
                    $this->data['supplierName'] = $supplier->name;

                    $this->data['requiresAccept'] = $supplier->requiresAccept;

                    if (isset($supplier->policy)) {
                        $this->data['supplierPolicy'] = $supplier->policy;
                    }
                } else {
                    $this->data['supplierHost'] = $host;
                }
            }
        }

        return $this->data;
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
