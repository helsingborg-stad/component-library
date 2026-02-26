<?php

namespace ComponentLibrary\Component\NewsItem;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Class NewsItem
 * @package ComponentLibrary\Component\Navbar
 */
class NewsItem extends \ComponentLibrary\Component\BaseController implements NewsItemInterface
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'newsItem';
    }

    // -------------------------------------------------------------------------
    // NewsItemInterface — generated getters
    // -------------------------------------------------------------------------

    public function getHeading(): string
    {
        return $this->data['heading'] ?? null;
    }

    public function getSubHeading(): string
    {
        return $this->data['subHeading'] ?? null;
    }

    public function getContent(): string
    {
        return $this->data['content'] ?? null;
    }

    public function getImage(): array
    {
        return $this->data['image'] ?? null;
    }

    public function getDate(): array
    {
        return $this->data['date'] ?? null;
    }

    public function getReadTime(): string
    {
        return $this->data['readTime'] ?? null;
    }

    public function getStanding(): bool
    {
        return $this->data['standing'] ?? false;
    }

    public function getLink(): string
    {
        return $this->data['link'] ?? null;
    }

    public function getHasPlaceholderImage(): bool
    {
        return $this->data['hasPlaceholderImage'] ?? null;
    }
}
