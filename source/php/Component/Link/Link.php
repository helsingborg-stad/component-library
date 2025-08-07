<?php

namespace ComponentLibrary\Component\Link;

class Link extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Link
        if (!empty($href)) {
            $this->data['attributeList']['href'] = $this->sanitizeHref($href);
        } else {
            if ($keepWrapper && $componentElement === 'span') {
                $this->data['componentElement'] = 'div';
            }
        }

        //Target
        if ($target && $href) {
            $this->data['attributeList']['target'] = $target;
        }

        //XFN
        if ($xfn) {
            $this->data['attributeList']['rel'] = $xfn;
        }
    }

    /**
     * Sanitize the href attribute
     * 
     * This will format phone numbers and emails correctly
     * 
     * @param string $href  The href attribute
     * 
     * @return string       The sanitized href
     */
    private function sanitizeHref(?string $href): string
    {
        if(empty($href)) {
            return '';
        }
        $scheme = parse_url($href, PHP_URL_SCHEME);
        return match ($scheme) {
            'tel', 'mailto' => $scheme . ':' . preg_replace('/\s+|-/', '', substr($href, strlen($scheme) + 1)),
            default => $href,
        };
    }
}
