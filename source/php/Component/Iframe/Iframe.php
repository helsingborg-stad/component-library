<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        extract($this->data);

        $this->data['attributeList']['allowfullscreen'] = true;

        if (empty($id)) {
            $this->data['id'] = "iframe-" . uniqid();
        }

        if (isset($width)) {
            $this->data['attributeList']['width'] = $width;
        }

        if (isset($height)) {
            $this->data['attributeList']['height'] = $height;
        }

        if (isset($frameborder)) {
            $this->data['attributeList']['frameborder'] = $frameborder;
        }

        if (isset($loading)) {
            $this->data['attributeList']['loading'] = $loading;
        }

        if (isset($modifier)) {
            $this->data['modifier'] = $modifier;
        }

        if (isset($src)) {
            // $url = $this->buildEmbedUrl($src);
            $this->data['attributeList']['src'] = $src;

            if (empty($poster) && function_exists('apply_filters')) {
                $this->data['poster'] = apply_filters('ComponentLibrary/Iframe/Poster', $url);
            }
        }

        if (isset($labels)) {
            $this->data['labels'] = $labels;
        }
        
        if(!empty($poster)) {
            $this->data['attributeList']['poster'] = $poster;
            $this->data['poster'] = $poster;
        }

        $this->data['attributeList']['title'] = $title;
        $this->data['attributeList']['aria-label'] = $title;

        $this->data['embeddedDomain'] = $this->getDomainFromUrl($src);
    }
    

    /**
     * Gets the domain from a given URL.
     *
     * @param string $url The URL from which to extract the domain.
     * @return string|false The extracted domain or false if not available.
     */
    private function getDomainFromUrl($url) {
        return parse_url($url)['host'];
    }
}
