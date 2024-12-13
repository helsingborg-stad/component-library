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
        $this->data['floatingSlotHasData']     = $this->slotHasData('floating');
        $this->data['aboveContentSlotHasData'] = $this->slotHasData('aboveContent');
        $this->data['belowContentSlotHasData'] = $this->slotHasData('belowContent');

        if ($image || $hasPlaceholder) {
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

        $this->data['imageExists'] = $this->hasImage($image);

        $this->data['contentHtmlElement'] = $this->getContentHTMLElement($content);
    }
    
    /**
     * Check if the image is set
     * 
     * @param mixed $image
     * 
     * @return bool
     */
    private function hasImage($image) {
        if (is_a($image, 'ComponentLibrary\Integrations\Image\Image')) {
            return !empty($image->getUrl());
        }
        if (is_array($image)) {
            return !empty($image['src']);
        }
        return !empty($image);
    }

    /**
     * Get the type of content wrapper that should be used
     * 
     * @param string $content
     * 
     * @return string
     */
    private function getContentHTMLElement($content) {
        if (strpos($content, '<p>') !== false) {
            return 'span';
        }
        return 'p';
    }
}
