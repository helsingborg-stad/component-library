<?php

namespace ComponentLibrary\Component\Card;

use ComponentLibrary\Helper\Str;
use ComponentLibrary\Helper\TagSanitizer;
use Helper\ATagSanitizer;

/**
 * Class Card
 * @package ComponentLibrary\Component\Card
 */
class Card extends \ComponentLibrary\Component\BaseController
{
    private array $slotMapping = [
        'afterContent' => 'afterContentSlotHasData',
        'floating'     => 'floatingSlotHasData',
        'aboveContent' => 'aboveContentSlotHasData',
        'belowContent' => 'belowContentSlotHasData',
        'slot'         => 'slotHasData'
    ];

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['collpaseID'] = uniqid();

        if ($image || $hasPlaceholder) {
            $this->data['classList'][] = $this->getBaseClass('has-image', true);
        }

        if ($date && !is_array($date)) {
            $this->data['date'] = [
                'timestamp' => $date,
                'action' => 'formatDate'
            ];
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

        if (!empty($hasPlaceholder)) {
            $this->data['classList'][] = $this->getBaseClass() . '--svg-background';
        }

        if (is_array($image) && !isset($image['backgroundColor'])) {
            $this->data['image']['backgroundColor'] = 'primary';
        }

        if ($link) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $link;
            
            if (!empty($linkText) && function_exists('apply_filters')) {
                $this->data['linkTextIcon'] = apply_filters('ComponentLibrary/Component/Card/LinkTextIcon', 'east');
            }
        } else {
            $this->data['componentElement'] = "div";
        }

        if ($link) {
            $this->data['classList'][] = $this->getBaseClass() . '--action';
        }

        if ($ratio) {
            $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);
        }

        //Add aria-label to card if link is present
        if ($link && $heading && $content && empty($this->data['attributeList']['aria-label'])) {
            $this->data['attributeList']['aria-label'] = $heading . " - ". Str::truncateSentence(
                strip_tags($content)
            );
        }
      
        $this->data['imageExists'] = $this->hasImage($image);

        $this->data['contentHtmlElement'] = $this->getContentHTMLElement($content);

        if ($content && $this->data['componentElement'] === 'a') {
            $this->data['content'] = $this->tagSanitizer->removeATags((string) $content);
        }

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
            if ($this->data[$hasDataKey] && $this->data['componentElement'] === 'a') {
                $this->data[$slot] = $this->tagSanitizer->removeATags((string) $this->data[$slot]);
            }
        }
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
        if (!is_string($content) || strpos($content, '<p>') !== false) {
            return 'div';
        }
        return 'p';
    }
}
