<?php

namespace ComponentLibrary\Component\Card;

/**
 * Class Card
 * @package ComponentLibrary\Component\Card
 */
class Card extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['collpaseID'] = uniqid();

        $this->data['classList'][] = $this->getBaseClass() . '--' . $color;

        if (isset($image['padded']) && $image['padded']) {
                $this->data['paddedImage'] = $this->getBaseClass() . '__image-background--padded';
        }

        if($imageFirst || !$image) {
                $this->data['classList'][] = $this->getBaseClass() . '--image-first';
        }     
        
        if ($hasFooter || $tags || $buttons) {
                $this->data['classList'][] = $this->getBaseClass() . '--has-footer';
        }

        if ($collapsible && $content) {
                $this->data['collapsible'] = $this->getBaseClass() . '--collapse';
        }

        if (!empty($image) && is_string($image)) {
                $image = $this->data['image'] = [
                        'src' => $image
                ];
        }

        if ($hasPlaceholder) {
            $this->data['classList'][] = $this->getBaseClass() . '--svg-background';
        }

        if ($image && !isset($image['src']) || (isset($image['src']) && empty($image['src']))) {
                $this->data['image'] = false;
        }

        if (is_array($image) && !isset($image['backgroundColor'])) {
                $this->data['image']['backgroundColor'] = 'primary';
        }

        if ($link) {
                $this->data['componentElement'] = "a";
                $this->data['attributeList']['href'] = $link;
        } else {
                $this->data['componentElement'] = "div";
        }

        if ($link) {
                $this->data['classList'][] = $this->getBaseClass() . '--action';
        }

        if ($ratio) {
                $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);
        }
    }
}
