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
            $url = $this->buildEmbedUrl($src);
            $this->data['attributeList']['src'] = $url;

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
     * Build embed url
     *
     * @param string    $src    Arbitrary embed url
     * @return string   $src    Correct embed url
     */
    private function buildEmbedUrl($src)
    {
        $srcParsed = parse_url($src);

        $ytParams = 'autoplay=1&showinfo=0&rel=0&mute=1&modestbranding=1&cc_load_policy=1';

        switch ($srcParsed['host']) {
            case 'youtube.com':
            case 'www.youtube.com':
                /*
                Replacing the path with /embed/ and then
                adding the v query parameter to the path
                and removing the v parameter from the
                query string.
                */
                $srcParsed['host'] = 'youtube.com';
                $srcParsed['path'] = '/embed/';

                if (isset($srcParsed['query'])) {
                    parse_str($srcParsed['query'], $query);
                    if (isset($query['v'])) {
                        $srcParsed['path'] .= $query['v'];
                        $srcParsed['query'] = $ytParams;
                    }
                }
                break;
            case 'youtu.be':
                $srcParsed['host'] = 'youtube.com';
                if (isset($srcParsed['path'])) {
                    $srcParsed['path'] = '/embed/' . $srcParsed['path'];
                    $srcParsed['query'] = $ytParams;
                }
                break;
            case 'vimeo.com':
            case 'www.vimeo.com':
                $srcParsed['host'] = 'player.vimeo.com';
                if (isset($srcParsed['path'])) {
                    $srcParsed['path'] = '/video' . $srcParsed['path'] . "?autoplay=1&autopause=0&muted=1";
                }
                break;
            case 'spotify.com':
            case 'www.spotify.com':
            case 'open.spotify.com':
                $srcParsed['host'] = 'open.spotify.com';
                $srcParsed['path'] = '/embed' . $srcParsed['path'];
                $srcParsed['query'] = 'utm_source=oembed';
                break;
            default:
                break;
        }

        $scheme = $srcParsed['scheme'] ?? 'https';
        $embedUrl = $scheme . '://' . strtolower($srcParsed['host']);

        if (isset($srcParsed['path'])) {
            $embedUrl .= $srcParsed['path'];
        }
        if (isset($srcParsed['query'])) {
            $embedUrl .= '?' . $srcParsed['query'];
        }

        return $embedUrl;
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
