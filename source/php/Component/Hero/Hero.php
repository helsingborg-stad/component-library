<?php

namespace ComponentLibrary\Component\Hero;

class Hero extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        $this->data['attributeList']['role'] = 'region';
        $this->data['attributeList']['aria-label'] = $ariaLabel;

        if ($stretch) {
            $this->data['classList'][] = $this->getBaseClass() . "--stretch";
        }

        if ($video) {
            $this->data['classList'][] = $this->getBaseClass() . "--video";
        }

        if (!$video) {
            $this->data['classList'][] = $this->getBaseClass() . "--image";
        }

        //Create image style tag
        $this->data['imageStyle'] = [];

        //Add image to image styles
        if ($image) {
            $this->data['imageStyle']['background-image'] = "url('" . $image . "')";

            //Add background position to image styles
            if (isset($imageFocus) && is_array($imageFocus) && array_filter($imageFocus)) {
                $this->data['imageStyle']['background-position'] = $imageFocus['left'] . "% " . $imageFocus['top'] . "%";
            }

            //Stringify image styles
            $this->data['imageStyleString'] = self::buildInlineStyle($this->data['imageStyle']);
        }

        if ($video) {
            $this->data['videoUrl'] = $video;
        }

        //Ratio
        if ($size) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $size;
        }

        //Overlay
        if ($title || $paragraph || $byline) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay';
            $this->data['overlay'] = true;
        } else {
            $this->data['overlay'] = false;
        }

        if ($animation) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $animation;
            $this->data['classList'][] = $this->getBaseClass() . '--has-animation';
            $this->data['hasAnimation'] = true;
        } else {
            $this->data['hasAnimation'] = false;
        }

        /* Different hero types */
        if($type) {
            $this->data['contentSlotHasData'] = $this->slotHasData('content');
            if(is_string($type)) {
                $this->data['type'] = 'Hero.views.' . $type;
                $this->data['classList'][] = $this->getBaseClass() . '--' . $type;
            } else {
                $this->data['type'] = 'Hero.views.' . $type['type'];
                $this->data['classList'][] = $this->getBaseClass() . '--' . $type['type'];
                $this->data['background'] = $type['background'] ? $type['background'] : ($type['image'] ? 'url(' .$type['image'] . ')' : '');
                $this->data['imageSrc'] = $type['image'] ? $type['image'] : '';

                if($type['modifiers']) {
                    if(is_string($type['modifiers'])) {
                        $type['modifiers'] = explode(" ", $type['modifiers']);
                    }
                    foreach($type['modifiers'] as $modifier) {
                        $this->data['classList'][] = $this->getBaseClass() . '--' . $modifier;
                    }
                }
            }  
        }
    }
}
