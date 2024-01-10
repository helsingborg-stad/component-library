<?php

namespace ComponentLibrary\Component\Acceptance;

class Acceptance extends \ComponentLibrary\Component\BaseController
{
    //Indicated that there are exceptions of js behaviors in frontend
    private $jsBehaviourSystemTypes = ['video'];

    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        $this->data['requiresAccept'] = true;

        $this->data['classList'][] = 'js-suppressed-content';
        $this->data['classList'][] = 'u-level-1';

        if (isset($icon)) {
            $this->data['icon'] = $icon;
        }
        
        if (!empty($src)) {
            $this->data['attributeList']['data-src'] = json_encode($src, JSON_UNESCAPED_SLASHES);

            if (is_string($src)) {
                $src = array($src);
            }

            $this->data = $this->setSupplierDataAttributes($src, $this->data);
        }

        if (!empty($this->data['supplierSystemType'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $this->data['supplierSystemType'];

            if (in_array($this->data['supplierSystemType'], $this->jsBehaviourSystemTypes)) {
                $this->data['classList'][] = 'js-suppressed-content--' . $this->data['supplierSystemType'];
            } else {
                $this->data['classList'][] = 'js-suppressed-content--none';
            }
        }
        
        if ($cover)
        {
            $this->data['attributeList']['style'][] = "background-image:url(\"$cover\");background-size:cover";
        }

        if (!empty($height)) {
            $this->data['attributeList']['style'][] = "height:{$height}px";
        }
        
        if (!empty($this->data['labels'])) {
            $knownLabels = json_encode($this->data['labels']['knownLabels']);
            $unknownLabels = json_encode($this->data['labels']['unknownLabels']);

            if (isset($this->data['labels']->infoLabel)) {
                $this->data['infoLabel'] = $this->data['labels']->infoLabel;
            }

            if (!empty($this->data['supplierPolicy'])) {
                $knownLabels = str_replace(
                    array('{SUPPLIER_WEBSITE}', '{SUPPLIER_POLICY}'),
                    array($this->data['supplierName'], $this->data['supplierPolicy']),
                    $knownLabels
                );

                $this->data['labels'] = json_decode($knownLabels);
            } else {
                $unknownLabels = str_replace(
                    '{SUPPLIER_WEBSITE}',
                    $this->data['supplierHost'],
                    $unknownLabels
                );
                $this->data['labels'] = json_decode($unknownLabels);
            }
        }
        
        if (!empty($this->data['attributeList']['style']) && is_iterable($this->data['attributeList']['style'])) {
            $this->data['attributeList']['style'] = implode(';', $this->data['attributeList']['style']);
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
                array('maps.google.com', 'maps.google.se', 'google.com', 'www.google.com', 'google.se', 'www.google.se'),
                'https://policies.google.com/privacy',
                true,
                'map'
            ),
            new Supplier(
                'ArcGIS',
                array('helsingborg.maps.arcgis.com', 'maps.arcgis.com'),
                'https://www.esri.se/sv-se/integritet/gdpr',
                true,
                'map'
            ),
            new Supplier(
                'YouTube',
                array('youtube.com', 'www.youtube.com', 'youtu.be'),
                'https://policies.google.com/privacy',
                true,
                'video'
            ),
            new Supplier(
                'Vimeo',
                array('vimeo.com', 'www.vimeo.com', 'player.vimeo.com'),
                'https://vimeo.com/privacy',
                true,
                'video'
            ),
            new Supplier(
                'Helsingborg Stad',
                array('helsingborg.se', 'www.helsingborg.se', 'driftinfo.helsingborg.se', 'it.helsingborg.se', 'ettbattre.helsingborg.se'),
                'https://helsingborg.se/om-webbplatsen/sa-har-behandlar-vi-dina-personuppgifter/',
                false,
                'municipal'
            ),
            new Supplier(
                'Mynewsdesk',
                array( 'helsingborg.mynewsdesk.com', 'mynewsdesk.com'),
                'https://www.mynewsdesk.com/se/about/terms-and-conditions/',
                true,
                'news'
            ),
            new Supplier(
                'KommersAnnons.se',
                array( 'kommersannons.se', 'www.kommersannons.se'),
                'https://kommersannons.se/',
                true,
                'money'
            ),
            new Supplier(
                'Stratsys',
                array( 'stratsys.se', 'www.stratsys.se', 'jamforelse.stratsys.se'),
                'https://www.stratsys.com/sv/integritetspolicy',
                false,
                'stats'
            ),
            new Supplier(
                'Sparkle',
                array('5p4rk13.com'),
                'https://getsparkle.io/terms/',
                true,
                'social'
            ),
            new Supplier(
                'Curator',
                array('cdn.curator.io', 'curator.io'),
                'https://curator.io/privacy-policy',
                true,
                'social'
            ),
            new Supplier(
                'Visma',
                array('visma.se', 'visma.com', 'minsida.siriusit.net', 'siriusit.net'),
                'https://www.visma.com/privacy-statement/sweden/',
                false,
                'login'
            ),
            new Supplier(
                'Twoday',
                array('twoday.se'),
                'https://twoday.se/privacy-policy',
                false,
                'login'
            )
        );

        if (function_exists('apply_filters')) {
            return apply_filters($this->createFilterName($this) . '/' . ucfirst(__FUNCTION__), $suppliers);
        }

        return $suppliers;
    }

    /**
     * Set supplier data attributes
     *
     * @param array $src
     * @param array $data
     * @return array
     */
    private function setSupplierDataAttributes(array $src, array $data)
    {
        $this->data = $data;

        if (count($src) > 1) {
            foreach ($src as &$value) {
                $url = \ComponentLibrary\Helper\URL::normalizeUrl($value);
                $value = parse_url($url)['host'];
            }
            $this->data['supplierHost']         = strtolower(implode(', ', $src));
            $this->data['supplierSystemType']   = 'general';
        } else {
            $suppliers  = $this->getSuppliers();
            
            $url = \ComponentLibrary\Helper\URL::normalizeUrl($src[0]);
            $srcParsed  = parse_url($url);
            $host       = strtolower($srcParsed['host']);

            if (is_iterable($suppliers)) {
                foreach ($suppliers as $supplier) {
                    $key = array_search($host, $supplier->domain, true);
                    if (is_integer($key)) {
                        $this->data['supplierHost']         = $supplier->domain[$key];
                        $this->data['supplierName']         = $supplier->name;
                        $this->data['requiresAccept']       = $supplier->requiresAccept;
                        $this->data['supplierSystemType']   = $supplier->systemType;

                        if (isset($supplier->policy)) {
                            $this->data['supplierPolicy'] = $supplier->policy;
                        }

                        break;
                    } else {
                        $this->data['supplierHost']         = $host;
                        $this->data['supplierSystemType']   = 'general';
                    }
                }
            }
        }

        return $this->data;
    }
}

class Supplier
{
    public function __construct(
        string $name,
        array $domain,
        string $policy = '',
        bool $requiresAccept = true,
        string $systemType = 'general'
    ) {
        $this->name = $name;
        $this->domain = $domain;
        $this->policy = $policy;
        $this->requiresAccept = $requiresAccept;
        $this->systemType = $systemType;
    }
}