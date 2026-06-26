<?php

namespace ComponentLibrary\Component\Logotype;

class Logotype extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add placeholder class
        if (!$src) {
            $this->data['classList'][] = $this->getBaseClass() . '--is-placeholder';
        }

        //Inherit the alt text
        if (!$alt && $caption) {
            $this->data['alt'] = $this->data['caption'];
        }

        // Add maskable class and attribute only when src is SVG and maskable is true
        $isMaskable = (bool) ($maskable ?? false);
        if ($isMaskable && $src && $this->isSvgSource($src)) {
            if (!isset($this->data['attributeList']) || !is_array($this->data['attributeList'])) {
                $this->data['attributeList'] = [];
            }

            $this->data['attributeList']['data-logotype-maskable'] = 'true';
            $this->data['attributeList']['data-logotype-maskable-src'] = $src;

            $existingStyle = (string) ($this->data['attributeList']['style'] ?? '');
            if (strpos($existingStyle, '--c-logotype--mask-image') === false) {
                $maskImageStyle = '--c-logotype--mask-image: url("' . $src . '");';
                $this->data['attributeList']['style'] = trim($existingStyle . ' ' . $maskImageStyle);
            }

            $this->data['classList'][] = $this->getBaseClass() . '--is-maskable';
        }
    }

    /**
     * Determines whether a source path points to an SVG file.
     *
     * @param mixed $src
     *
     * @return bool
     */
    private function isSvgSource($src): bool
    {
        if (!is_string($src) || $src === '') {
            return false;
        }

        $path = parse_url($src, PHP_URL_PATH);
        if (!is_string($path) || $path === '') {
            $path = $src;
        }

        return strtolower((string) pathinfo($path, PATHINFO_EXTENSION)) === 'svg';
    }
}
