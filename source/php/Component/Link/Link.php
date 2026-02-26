<?php

namespace ComponentLibrary\Component\Link;

class Link extends \ComponentLibrary\Component\BaseController implements LinkInterface
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

        //Unstyled
        if ($unstyled) {
            $this->data['classList'][] = $this->getBaseClass('unstyled', true);
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
    public function sanitizeHref(?string $href): string
    {
        if(empty($href)) {
            return '';
        }
        
        $href   = trim($href);
        $href   = html_entity_decode($href, ENT_QUOTES | ENT_HTML5);
        $scheme = parse_url($href, PHP_URL_SCHEME);
        
        return match ($scheme) {
            'tel' => $scheme . ':' . preg_replace('/\s+|-/', '', substr($href, strlen($scheme) + 1)),
            'mailto' => $scheme . ':' . preg_replace('/\s+/', '', substr($href, strlen($scheme) + 1)),
            default => $href,
        };
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'link';
    }

    // -------------------------------------------------------------------------
    // LinkInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'span';
    }

    public function getSlot(): string
    {
        return $this->data['slot'] ?? 'Undefined label';
    }

    public function getHref(): string
    {
        return $this->data['href'] ?? '';
    }

    public function getTarget(): string
    {
        return $this->data['target'] ?? '_top';
    }

    public function getKeepContent(): bool
    {
        return $this->data['keepContent'] ?? true;
    }

    public function getKeepWrapper(): bool
    {
        return $this->data['keepWrapper'] ?? true;
    }

    public function getXfn(): bool
    {
        return $this->data['xfn'] ?? false;
    }

    public function getUnstyled(): bool
    {
        return $this->data['unstyled'] ?? false;
    }
}
