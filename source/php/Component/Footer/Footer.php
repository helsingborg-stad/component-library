<?php

namespace ComponentLibrary\Component\Footer;

class Footer extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['links'] = $this->addTargetToLinks($links);

        if (!isset($this->data['logotypeHref'])) {
            $this->data['logotypeHref'] = "/";
        }

        $this->data['displaySubFooter'] = $this->displaySubFooter(
            $subfooterLogotype ?? false,
            $subfooter['content'] ?? false
        );
    }

    /**
     * Toggle display of subfooter
     *
     * @param string $logotype
     * @param array $content
     * @return bool
     */
    private function displaySubFooter($logotype, $content): bool
    {
        if (!$logotype && empty($content)) {
            return false;
        }
        return true;
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