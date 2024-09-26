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

        $this->data['afterContentSlotHasData'] = $this->slotHasData('afterContent');

        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');

        if (isset($image['padded']) && $image['padded']) {
            $this->data['paddedImage'] = $this->getBaseClass() . '__image-background--padded';
        }

        if ($image && !empty($image['src'])) {
            $this->data['classList'][] = $this->getBaseClass('has-image', true);
        }

        if ($dateBadge && $date) {
            $this->data['classList'][] = $this->getBaseClass('has-datebadge', true);
        }

        if ($imageFirst || !$image) {
            $this->data['classList'][] = $this->getBaseClass() . '--image-first';
        }

        if ($hasFooter || $tags || $buttons) {
            $this->data['classList'][] = $this->getBaseClass() . '--has-footer';
        }

        if ($metaFirst) {
            $this->data['classList'][] = $this->getBaseClass() . '--meta-first';
        }

        if ($collapsible && $content) {
            $this->data['collapsible'] = $this->getBaseClass() . '--collapse';
        }

        if (!empty($image) && is_string($image)) {
            $image = $this->data['image'] = [
                    'src' => $image
            ];
        }

        if (!empty($icon)) {
            $this->data['icon']['classList'][] = $this->getBaseClass('icon');
        }
        
        if (!isset($this->data['displayIcon'])) {
            $this->data['displayIcon'] = true;
        }

        if (!empty($hasPlaceholder)) {
            $this->data['classList'][] = $this->getBaseClass() . '--svg-background';
        }

        if(is_array($image)) {
            if ($image && !isset($image['src']) || (isset($image['src']) && empty($image['src']))) {
                $this->data['image'] = false;
            }
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
