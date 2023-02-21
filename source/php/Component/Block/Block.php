<?php

namespace ComponentLibrary\Component\Block;

/**
 * Class Block
 * @package ComponentLibrary\Component\Block
 */
class Block extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        if ($image && !isset($image['backgroundColor'])) {
            $this->data['image']['backgroundColor'] = 'primary';
        }

        if (isset($hasPlaceholder) && $hasPlaceholder) {
            $this->data['classList'][] = $this->getBaseClass() . '--svg-background';
        }

        if ($link) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $link;
        } else {
            $this->data['componentElement'] = "div";
        }

        if (!in_array($ratio, ['1:1', '4:3', '12:16', '16:9'])) {
            $ratio = '4:3';
        }

        if ($content) {
            $this->data['content'] = strip_tags($content);
        }

        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);
        if ($icon) {
            if (!isset($icon['attributes']['data-post-type']) || empty($icon['attributes']['data-post-type'])) {
                $icon['attributes']['data-post-type'] = $postType;
            }
            if (!empty($postId)) {
                $icon['attributes']['data-post-id'] = strval($postId);
            }
            $icon['classes'][] = 'c-card__icon';
            $this->data['icon'] = $icon;
        }
    }
}
