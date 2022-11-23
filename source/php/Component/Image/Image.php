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
        if (!$alt && $caption) {
            $this->data['alt'] = $this->data['caption'];
        }

        //Rounded corners all sides
        if ($rounded) {
            $this->data['classList'][] = $this->getBaseClass() . "--rounded ";
        }

        //Rounded corners top left
        if ($roundedTopLeft) {
            $this->data['classList'][] = $this->getBaseClass() . "--rounded-top-left ";
        }

        //Rounded corners top right
        if ($roundedTopRight) {
            $this->data['classList'][] = $this->getBaseClass() . "--rounded-top-right ";
        }

        //Rounded corners bottom left
        if ($roundedBottomLeft) {
            $this->data['classList'][] = $this->getBaseClass() . "--rounded-bottom-left ";
        }

        //Rounded corners bottom right
        if ($roundedBottomRight) {
            $this->data['classList'][] = $this->getBaseClass() . "--rounded-bottom-right ";
        }

        //Rounded corners radius
        if ($roundedRadius) {
            $this->data['classList'][] = $this->getBaseClass() . "--rounded-" . $roundedRadius;
        }

        if ($openModal) {
            $this->data['modalId'] = uniqid();
            $this->data['imgAttributeList']['data-open'] = $this->data['modalId'];
            $this->data['imgAttributeList']['class'][] = $this->getBaseClass() . '__modal';
        }
        
        $this->data['imgAttributeList']['class'][] = $this->getBaseClass() . '__image';
        
        $this->data['imgAttributeList']['class'] = implode(' ', $this->data['imgAttributeList']['class']);
        
        $this->data['imgAttributes'] = self::buildAttributes(
            $this->data['imgAttributeList']
        );
    }
}
