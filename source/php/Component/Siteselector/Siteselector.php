<?php

namespace ComponentLibrary\Component\Siteselector;

class Siteselector extends \ComponentLibrary\Component\BaseController
{
    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Border radius
        if($radius) {
            $this->data['classList'][] = $this->getBaseClass('radius-' . $radius, true); 
        }

        //Color scheme
        if($color) {
            $this->data['classList'][] = $this->getBaseClass($color, true); 
        }

        //Disable max items 
        if(!is_numeric($maxItems)) {
            $this->data['maxItems'] = $maxItems = false;
            $this->data['hiddenItems']= $hiddenItems = false;
        } elseif(is_numeric($maxItems)) {
            $slicedItems = $this->sliceItems(
                $items,
                $maxItems,
                true
            );

            $slicedHiddenItems = $this->sliceItems(
                $items,
                $maxItems,
                false
            );

            $this->data['items']        = $items = $slicedItems; 
            $this->data['hiddenItems']  = $hiddenItems = $slicedHiddenItems;
        }

        //Normalize
        $this->data['items']        = $items = $this->normalizeItems($this->data['items']); 
        $this->data['hiddenItems']  = $hiddenItems = $this->normalizeItems($this->data['hiddenItems'], 1); 

        //Hightlight current site
        $this->data['items']        = $items = $this->hightlightItems($this->data['items']); 
        $this->data['hiddenItems']  = $hiddenItems = $this->hightlightItems($this->data['hiddenItems']); 
 
        //Combine (make hidden items appear as a dropdown)
        if($hiddenItems) {
            $this->data['items'][] = [
                'id' => 'expand',
                'label' => $this->data['showMoreLabel'],
                'href' => '#expand',
                'ancestor' => 0,
                'children' => $hiddenItems,
                'classList' => [
                    $this->getBaseClass('more')
                ],
                'active' => false,
                'style' => 'default'
            ];
        }
    }

    /**
     * Slice the array of items based on a maximum number of items.
     *
     * @param array $items
     * @param int $maxItems
     * @param bool $visibleItems
     * @return array
     */
    private function sliceItems(array $items, int $maxItems, bool $visibleItems): array
    {
        if($visibleItems) {
            return array_slice($items, 0, $maxItems);
        }
        return array_slice($items, $maxItems);
        
    }

    /**
     * Normalize an array of items by filling in missing keys with default values.
     *
     * @param array $items
     * @return array
     */
    private function normalizeItems($items, $depth = null): array
    {
        if(!is_countable($items)) {
            return []; 
        }

        foreach($items as $key => &$item) {
            $item = array_merge(
                [
                    'id' => rand(1, PHP_INT_MAX),
                    'label' => "Unknown",
                    'ancestor' => false,
                    'active' => false,
                    'children' => false,
                    'href' => "#",
                    'classList' => [
                        $this->getBaseClass('item')
                    ],
                    'style' => "default",
                ],
                $item
            );

            if(is_numeric($depth)) {
                $item['depth'] = $depth;
            }
        }

        return $items;
    }

    /**
     * Get the current domain that is running the application.
     * 
     * @return string
     */
    private function getCurrentDomain(): string {
        return $_SERVER['HTTP_HOST'] ?? '';
    }

    /**
     * Get hostname form a full uri. 
     * 
     * @return string
     */
    private function getDomainFromUrl(string $url): string
    {
        return parse_url($url)['host'] ?? '';
    }

    /**
     * Check if the provided url is matching the current domain
     * 
     * @return bool
     */
    private function isCurrentDomain(string $url): bool 
    {
        if($this->getCurrentDomain() == $this->getDomainFromUrl($url)){
            return true; 
        }
        return false; 
    }

    /**
     * Add is-current class to the current item
     * 
     * @return array
     */
    private function hightlightItems($items): array 
    {

        if(is_countable($items)) {
            foreach($items as &$item) {
                if($this->isCurrentDomain($item['href']) === true) {
                    $item['active'] = true; 
                } else {
                    $item['active'] = false;
                }
            }
        }
        return $items;
    }
}
