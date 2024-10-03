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

        //Detect if the slots have data
        $this->data['afterContentSlotHasData'] = $this->slotHasData('afterContent');
        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');

        if ($image) {
            $this->data['classList'][] = $this->getBaseClass('has-image', true);
        }

        if ($dateBadge && $date) {
            $this->data['classList'][] = $this->getBaseClass('has-datebadge', true);
        }

        if ($tags || $buttons) {
            $this->data['classList'][] = $this->getBaseClass('has-footer', true);
        }

        if ($collapsible && $content) {
            $this->data['collapsible'] = $this->getBaseClass() . '--collapse';
        }

        //Cast image data to array structure
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

        //Determine if the card has an image
        $this->data['imageExists'] = true;
        if(is_a($image, 'ComponentLibrary\Integrations\Image\Image')) {
            if(empty($image->getUrl())) {
                $this->data['imageExists'] = false;
            }
        } elseif(is_array($image)) {
            if ($image && !isset($image['src']) || (isset($image['src']) && empty($image['src']))) {
                $this->data['imageExists'] = false;
            }
        }

    }
}
