<?php

namespace ComponentLibrary\Component\Image;

class Image extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add placeholder class
        if (!$src) {
            $this->data['classList'][] = $this->getBaseClass() . "--is-placeholder";
        }

        //Filetype
        if ($src && $extension = pathinfo($src, PATHINFO_EXTENSION)) {
            $this->data['classList'][] = $this->getBaseClass() . "--type-" . $extension;
        }

        //Make full width
        if ($fullWidth) {
            $this->data['classList'][] = $this->getBaseClass() . "--full-width";
        }

        //Inherit the alt text
        if (!$alt) {
            $this->data['alt'] = !empty($caption) ? $caption : "";
        }
        
        if (!empty($byline)) {
            $this->data['byline'] = $byline;
        }

        //Inherit the caption text
        if (empty($heading) && $caption) {
            $this->data['heading'] = $caption;
        } else {
            $this->data['heading'] = "";
        }

        if (empty($isPanel)) {
            $this->data['isPanel'] = false;
        }
        if (empty($isTransparent)) {
            $this->data['isTransparent'] = false;
        }

        //Rounded corners all sides
        if (!empty($rounded)) {
            $this->data['classList'][] = $this->getBaseClass('radius-' . $rounded, true);
        }

        $this->data['imgAttributeList']['class'][] = $this->getBaseClass() . '__image';

        if ($openModal) {
            $this->data['modalId'] = uniqid();
            $this->data['imgAttributeList']['data-open'] = $this->data['modalId'];
            $this->data['imgAttributeList']['class'][] = $this->getBaseClass() . '__modal';
        }

        $this->data['imgAttributeList']['class'] = implode(' ', $this->data['imgAttributeList']['class']);

        $this->data['imgAttributes'] = self::buildAttributes(
            $this->data['imgAttributeList']
        );
    }
}
