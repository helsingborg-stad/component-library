<?php

namespace ComponentLibrary\Component\Hero;

class Hero extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        $this->data['contentStyles'] = "";
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

        if ($textColor) {
            $this->data['classList'][] = $this->getBaseClass() . "--color-" . $textColor;
        }

        $this->data['classList'][] = $this->getBaseClass() . '--' . $heroView;

        //Create image style tag
        $this->data['imageStyle'] = [];

        //Add image to image styles
        if ($image) {
            $this->data['image'] = $image;

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

        if ($contentAlignment && $contentAlignment["horizontal"] !== "left") {
            $this->data['classList'][] = $this->getBaseClass() . '--content-horizontal__' . $contentAlignment["horizontal"];
        }

        if ($contentAlignment && $contentAlignment["vertical"] !== "bottom") {
            $this->data['classList'][] = $this->getBaseClass() . '--content-vertical__' . $contentAlignment["vertical"];
        }
        
        if (!empty($contentBackgroundColor) &&  ($title || $paragraph || $byline || $meta)) {
            $this->data['overlay'] = false;
            $this->data['classList'][] = $this->getBaseClass() . '--has-content-background-color';
            $this->data['contentStyles'] .= "background-color: ${contentBackgroundColor};";
        }

        //Overlay
        if (empty($contentBackgroundColor) && ($title || $paragraph || $byline || $meta)) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay';
            $this->data['overlay'] = true;
        } else {
            $this->data['overlay'] = false;
        }

        if($meta) {
            $this->data['meta'] = $meta;
            $this->data['classList'][] = $this->getBaseClass() . '--meta';
        }

        if ($animation) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $animation;
            $this->data['classList'][] = $this->getBaseClass() . '--has-animation';
            $this->data['hasAnimation'] = true;
        } else {
            $this->data['hasAnimation'] = false;
        }

        if ($background) {
            $this->data['background'] = 'background:' . $background . ';';
        }

        $this->data['customHeroData'] = $this->handleCustomDataFunc($heroView, $customHeroData);

        if ($customHeroData && array_key_exists('modifiers', $customHeroData)) {
            if (!is_array($customHeroData['modifiers'])) {
                trigger_error(
                    sprintf(
                        'customHeroData["modifiers"] should be an array.',
                        print_r($this, true)
                    ),
                    E_USER_WARNING
                );
                return;
            } 
            foreach ($customHeroData['modifiers'] as $modifier) {
                $this->data['classList'][] = $this->getBaseClass() . '--' . $modifier;

                if ($modifier === "overflow") {
                    $this->data['background'] = $background ? 'background: ' . $background . ';' : 
                    ($image ? 'background-image:url(' . $image . ')' . ';' : '');
                }
            }
        }

        $this->data['contentStyles'] = $this->sanitizeInlineCss($this->data['contentStyles']);

    }

    private function handleCustomDataFunc($heroView, $customHeroData) {
        if (method_exists($this, $heroView)) {
            return $this->$heroView($customHeroData);
        } 
        
        return false;
    }

    private function twoColumn($customHeroData) {
        $data['contentSlotHasData'] = $this->slotHasData('content');

        return $data;
    }
}
