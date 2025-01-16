<?php

namespace ComponentLibrary\Component\Block;

/**
 * Class Block
 * @package ComponentLibrary\Component\Block
 */
class Block extends \ComponentLibrary\Component\BaseController
{
    private $contentKeys = ['date', 'meta', 'secondaryMeta', 'heading', 'icon', 'content'];

    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);
        
        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');
        $this->data['metaAreaSlotHasData'] = $this->slotHasData('metaArea');

        if ($image && is_array($image) && !isset($image['backgroundColor'])) {
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

        if (!empty($icon)) {
            $this->data['icon']['classList'][] = $this->getBaseClass('icon');
        }

        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);

        if(!$this->hasContent($this->data)) {
            $this->data['classList'][] = $this->getBaseClass("no-content", true);
        }

        $this->data['hasContent'] = $this->hasContent($this->data); 
    }

    private function hasContent($data): bool
    {
        $existingKeys = array_filter($this->contentKeys, function ($key) use ($data) {
            return array_key_exists($key, $data);
        });

        foreach ($existingKeys as $key) {

            $keyValue = $data[$key];

            if (!$this->contentElementIsEmpty($keyValue)) {
                return true;
            }
        }

        return false;
    }

    private function contentElementIsEmpty($value): bool
    {
        if (is_array($value) || is_object($value)) {
            foreach ((array)$value as $item) {
                if (!$this->contentElementIsEmpty($item)) {
                    return false;
                }
            }
        }

        if (is_numeric($value)) return false;
        if (is_string($value)) return empty(trim($value));

        return true;
    }
}
