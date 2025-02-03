<?php

namespace ComponentLibrary\Component\NewsItem;

/**
 * Class NewsItem
 * @package ComponentLibrary\Component\Navbar
 */
class NewsItem extends \ComponentLibrary\Component\BaseController
{
    public function init() {

        // Extract array for eazy access (fetch only)
        extract($this->data);

        // Header slots
        $this->data['headerRightAreaSlotHasData'] = $this->slotHasData('headerRightArea');
        $this->data['headerLeftAreaSlotHasData'] = $this->slotHasData('headerLeftArea');

        // Content slots
        $this->data['contentLeftAreaSlotHasData'] = $this->slotHasData('contentLeftArea');
        $this->data['contentRightAreaSlotHasData'] = $this->slotHasData('contentRightArea');

        // Title slots
        $this->data['titleLeftAreaSlotHasData'] = $this->slotHasData('titleLeftArea');
        $this->data['titleRightAreaSlotHasData'] = $this->slotHasData('titleRightArea');

        if ($date && !is_array($date)) {
            $this->data['date'] = [
                'timestamp' => $date,
                'action' => 'formatDate'
            ];
        }

        if ($standing) {
            $this->data['classList'][] = $this->getBaseClass('standing', true);
        }

        if ($link) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $link;
        } else {
            $this->data['componentElement'] = "div";
        }
    }
}
