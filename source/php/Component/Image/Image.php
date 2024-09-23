<?php

namespace ComponentLibrary\Component\Image;

use ComponentLibrary\Integrations\Image\ImageInterface;

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

        // Hanle image
        if($src instanceof ImageInterface) {

            //Get image sizes with container query data
            $this->data['containerQueryData'] = $src->getContainerQueryData();

            //Get the image URL and srcset, for fallback purposes. 
            $this->data['src']      = $src->getUrl();
            $this->data['srcset']   = $src->getSrcSet();

            //Resolves a focus point for the image, if any.
            $this->data['focus'] = "object-position: " . implode(" ", array_map(function($value) {
                return "{$value}%";
            }, 
                $src->getFocusPoint()
            )) . ";";

            //Set an alt text, from resolver, if not one provided
            if(empty($alt)) {
                $alt = $src->getAltText();
            }

            $src = $this->data['src'];
        }

        //Custom image attributes
        if($imgAttributeList) {
            $imgAttributeList = $this->data['imgAttributeList'] = self::buildAttributes($imgAttributeList);
        }

        //Filetype
        if ($extension = $this->getExtension($src)) {
            $this->data['classList'][] = $this->getBaseClass() . "--type-" . $extension;
        }

        //Make full width
        if ($fullWidth) {
            $this->data['classList'][] = $this->getBaseClass() . "--full-width";
        }

        //Make cover
        if ($cover) {
            $this->data['classList'][] = $this->getBaseClass('cover', true);
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

    private function getExtension(?string $src): ?string {
        if ($src && $extension = pathinfo($src, PATHINFO_EXTENSION)) {
            return $extension;
        }
        return null;
    }
}
