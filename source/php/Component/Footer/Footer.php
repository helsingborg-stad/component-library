<?php

namespace ComponentLibrary\Component\Footer;

class Footer extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['links'] = $this->addTargetToLinks($links);

        if(!isset($this->data['logotypeHref'])) {
            $this->data['logotypeHref'] = "/";
        }

        // Subfooter
        $subFooterClass = $subfooterClass ?? [];

        $subfooterDirection = $subfooter['direction'] === 'vertical' ? 'vertical' : 'horizontal';
        $subFooterClass[] = $this->getBaseClass() . '__subfooter--' . $subfooterDirection;
        $subFooterClass[] = $this->getBaseClass() . '__subfooter--align-' . $subfooter['alignment'] ?? 'flex-start';

        $this->data['subfooterClass'] = implode(' ', $subFooterClass);
    }

    protected function addTargetToLinks($arr)
    {
        foreach($arr as $key => $data) {
            if(array_key_exists('href', $data) && !array_key_exists('target', $data)) {
                $arr[$key]['target'] = '_self';
            }

            if(!array_key_exists('href', $data)) {
                $arr[$key] = $this->addTargetToLinks($data);
            }
        }
        return $arr;
    }
}