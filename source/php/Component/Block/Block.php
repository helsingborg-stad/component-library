<?php

namespace ComponentLibrary\Component\Block;

/**
 * Class Block
 * @package ComponentLibrary\Component\Block
 */
class Block extends \ComponentLibrary\Component\BaseController implements BlockInterface
{
    private $contentKeys = ['date', 'meta', 'secondaryMeta', 'heading', 'icon', 'content'];
    private array $slotMapping = [
        'floating' => 'floatingSlotHasData',
        'slot'     => 'slotHasData',
        'metaArea' => 'metaAreaSlotHasData'
    ];

    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);
        
        $this->data['floatingSlotHasData'] = $this->slotHasData('floating');
        $this->data['metaAreaSlotHasData'] = $this->slotHasData('metaArea');
        $this->data['slotHasData']         = $this->slotHasData('slot');

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

        if ($date && !is_array($date)) {
            $this->data['date'] = [
                'timestamp' => $date,
                'action' => 'formatDate'
            ];
        }

        if ($date) {
            $this->data['date']['classList'] ??= [];
            $this->data['date']['classList'][] = $this->getBaseClass('date');
        }


        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);

        if(!$this->hasContent($this->data)) {
            $this->data['classList'][] = $this->getBaseClass("no-content", true);
        }

        $this->data['hasContent'] = $this->hasContent($this->data);

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
            if ($this->data[$hasDataKey] && $this->data['componentElement'] === 'a') {
                $this->data[$slot] = $this->tagSanitizer->removeATags((string) $this->data[$slot]);
            }
        }
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'block';
    }

    // -------------------------------------------------------------------------
    // BlockInterface — generated getters
    // -------------------------------------------------------------------------

    public function getHeading(): string
    {
        return $this->data['heading'] ?? '';
    }

    public function getContent(): string|array
    {
        return $this->data['content'] ?? '';
    }

    public function getMeta(): string|array
    {
        return $this->data['meta'] ?? '';
    }

    public function getSecondaryMeta(): string|array
    {
        return $this->data['secondaryMeta'] ?? '';
    }

    public function getImage(): mixed
    {
        return $this->data['image'] ?? false;
    }

    public function getLink(): string
    {
        return $this->data['link'] ?? '';
    }

    public function getRatio(): string
    {
        return $this->data['ratio'] ?? '4:3';
    }

    public function getDate(): array
    {
        return $this->data['date'] ?? '';
    }

    public function getDateBadge(): bool
    {
        return $this->data['dateBadge'] ?? false;
    }

    public function getIcon(): bool|array
    {
        return $this->data['icon'] ?? false;
    }

    public function getIconBackgroundColor(): string
    {
        return $this->data['iconBackgroundColor'] ?? null;
    }
}
