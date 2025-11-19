<?php

namespace ComponentLibrary\Component\NewsItem;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Class NewsItem
 * @package ComponentLibrary\Component\Navbar
 */
class NewsItem extends \ComponentLibrary\Component\BaseController
{
    private array $slotMapping = [
        'headerRightArea'  => 'headerRightAreaSlotHasData',
        'headerLeftArea'   => 'headerLeftAreaSlotHasData',
        'contentLeftArea'  => 'contentLeftAreaSlotHasData',
        'contentRightArea' => 'contentRightAreaSlotHasData',
        'titleLeftArea'    => 'titleLeftAreaSlotHasData',
        'titleRightArea'   => 'titleRightAreaSlotHasData',
    ];

    public function init()
    {
        // Extract array for eazy access (fetch only)
        extract($this->data);

        if ($date && !is_array($date)) {
            $this->data['date'] = [
                'timestamp' => $date,
                'action' => 'formatDate'
            ];
        }

        if ($standing) {
            $this->data['classList'][] = $this->getBaseClass('standing', true);
        }

        $this->data['hasImage'] = false;
        if ($image instanceof ImageInterface) {
             $this->data['hasImage'] = $image->getUrl() ? true : false;
        } else {
             $this->data['hasImage'] = !empty($image['src']) ? true : false;
        }

        if ($link) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $link;
        } else {
            $this->data['componentElement'] = "div";
        }

        if ($this->data['componentElement'] === 'a') {
            $this->data['content'] = $content ? $this->tagSanitizer->removeATags($content) : null;
        }

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
            if ($this->data[$hasDataKey] && $this->data['componentElement'] === 'a') {
                $this->data[$slot] = $this->tagSanitizer->removeATags((string) $this->data[$slot]);
            }
        }
    }
}
