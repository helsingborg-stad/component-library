<?php

namespace ComponentLibrary\Component\Iframe;

class Iframe extends \ComponentLibrary\Component\BaseController implements IframeInterface
{
    public function init()
    {
        extract($this->data);

        $this->data['attributeList']['allowfullscreen'] = true;

        if (empty($id)) {
            $this->data['id'] = $this->sanitizeIdAttribute("iframe-" . uniqid());
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
            $this->data['attributeList']['src'] = $src;

            if (empty($poster) && function_exists('apply_filters')) {
                $this->data['poster'] = apply_filters('ComponentLibrary/Iframe/Poster', $src);
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'iframe';
    }

    // -------------------------------------------------------------------------
    // IframeInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSrc(): string
    {
        return $this->data['src'] ?? 'about:blank';
    }

    public function getLoading(): string
    {
        return $this->data['loading'] ?? 'lazy';
    }

    public function getWidth(): string
    {
        return $this->data['width'] ?? '100%';
    }

    public function getHeight(): string
    {
        return $this->data['height'] ?? '400';
    }

    public function getFrameborder(): string
    {
        return $this->data['frameborder'] ?? '0';
    }

    public function getLabels(): string
    {
        return $this->data['labels'] ?? '';
    }

    public function getModifier(): string
    {
        return $this->data['modifier'] ?? '';
    }

    public function getTitle(): string
    {
        return $this->data['title'] ?? 'External content';
    }

    public function getPoster(): bool
    {
        return $this->data['poster'] ?? false;
    }
}
