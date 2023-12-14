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

        $this->data['isSameTopDomain'] = $this->isSameDomain(
            $this->getDomainFromUrl($src), 
            $this->getCurrentDomain()
        );
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
     * Checks if two domains are the same.
     *
     * @param string $iframeDomain The domain of the iframe.
     * @param string $currentDomain The current domain.
     * @return bool True if the domains are the same, false otherwise.
     */
    private function isSameDomain($iframeDomain, $currentDomain) {
        return ($currentDomain === $iframeDomain);
    }

    /**
     * Gets the current domain based on the server name.
     *
     * @return string|false The current domain or false if not available.
     */
    private function getCurrentDomain() {
        if(isset($_SERVER['SERVER_NAME'])) {
            return $this->parseTopDomain($_SERVER['SERVER_NAME']);
        }
        return false;
    }

    /**
     * Gets the domain from a given URL.
     *
     * @param string $url The URL from which to extract the domain.
     * @return string|false The extracted domain or false if not available.
     */
    private function getDomainFromUrl($url) {
        return $this->parseTopDomain(
            parse_url($url)['host']
        ); 
    }

    /**
     * Parses the top-level domain from a full domain.
     *
     * @param string $domain The full domain.
     * @return string|false The top-level domain or false if not available.
     */
    private function parseTopDomain($domain) {
        return $domain
            ? implode('.', array_slice(explode('.', $domain), -2))
            : false;
    }

}
