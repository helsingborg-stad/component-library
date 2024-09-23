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
                $alt = $this->data['alt'] = $src->getAltText();
            }

            $src = $this->data['src'];
        }

        //Filetype
        if ($extension = $this->getExtension($src)) {
            $this->data['classList'][] = $this->getBaseClass("type-" . $extension, true);
        }

        //Make full width
        if ($fullWidth) {
            $this->data['classList'][] = $this->getBaseClass('full-width', true);
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

        //Modal in panel?
        if (empty($isPanel)) {
            $this->data['isPanel'] = false;
        }

        //Transparent
        if (empty($isTransparent)) {
            $this->data['isTransparent'] = false;
        }

        //Rounded corners all sides
        if (!empty($rounded)) {
            $this->data['classList'][] = $this->getBaseClass('radius-' . $rounded, true);
        }

        //Make modal
        if ($openModal) {
            $this->data['modalId'] = uniqid();
            $this->data['imgAttributeList']['data-open'] = $this->data['modalId'];
        }

        //Build attributes
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
