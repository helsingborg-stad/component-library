<?php

namespace ComponentLibrary\Component\Box;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Class Box
 * @package ComponentLibrary\Component\Box
 */
class Box extends \ComponentLibrary\Component\BaseController implements BoxInterface
{
    private array $slotMapping = [
        'metaArea' => 'metaAreaSlotHasData',
        'slot'     => 'slotHasData'
    ];

    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        if ($link) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $link;
        } else {
            $this->data['componentElement'] = "div";
        }

        if (!in_array($ratio, ['1:1', '4:3', '12:16'])) {
            $ratio = '1:1';
        }

        if ($content) {
            $this->data['content'] = $this->strWordCut(
                strip_tags($content),
                200
            );
        }

        if ($date && !is_array($date)) {
            $this->data['date'] = [
                'timestamp' => $date,
                'action' => 'formatDate'
            ];
        }

        //Make componet take string as ico param (backward compatibility)
        if (is_string($icon) && !empty($icon)) {
            $this->data['icon'] = ['name' => $icon];
        }

        //Reset - Decides how to switch between data inputs
        $this->renderMostImportant();

        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
            if ($this->data[$hasDataKey] && $this->data['componentElement'] === 'a') {
                $this->data[$slot] = $this->tagSanitizer->removeATags((string) $this->data[$slot]);
            }
        }
    }

    private function hasImage():bool
    {
        return match (true) {
            $this->data['image'] instanceof ImageInterface => true,
            is_array($this->data['image']) && empty($this->data['image']['src']) => true,
            default => false,
        };
    }

    /**
     * renderMostImportant
     */
    public function renderMostImportant()
    {
        //Reset icon if image set
        if($this->hasImage()) {
            $this->data['icon'] = null;
        } else {
            $this->data['image'] = null;
        }

        //Reset image if icon set
        if ($this->data['icon']['name'] ?? false) {
            $this->data['image'] = null;
        } else {
            $this->data['icon'] = null;
        }
    }

    /**
     * Create a excerpt from a string
     *
     * @param string $string
     * @param int $length
     * @param string $end
     * @return string
     */
    private function strWordCut($string, $length, $end = '...')
    {
        $string = strip_tags($string);

        if (strlen($string) > $length) {
            $stringCut = substr($string, 0, $length);
            $string = substr(
                $stringCut,
                0,
                strrpos($stringCut, ' ')
            ) . $end;
        }

        return $string;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'box';
    }

    // -------------------------------------------------------------------------
    // BoxInterface — generated getters
    // -------------------------------------------------------------------------

    public function getHeading(): string
    {
        return $this->data['heading'] ?? '';
    }

    public function getContent(): string
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

    public function getLink(): string
    {
        return $this->data['link'] ?? '';
    }

    public function getRatio(): string
    {
        return $this->data['ratio'] ?? '1:1';
    }

    public function getDate(): string
    {
        return $this->data['date'] ?? '';
    }

    public function getDateBadge(): bool
    {
        return $this->data['dateBadge'] ?? null;
    }

    public function getImage(): mixed
    {
        return $this->data['image'] ?? false;
    }

    public function getIcon(): string
    {
        return $this->data['icon'] ?? '';
    }
}
