<?php

namespace ComponentLibrary\Component\Segment;

class Segment extends \ComponentLibrary\Component\BaseController implements SegmentInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $file_path = __DIR__ . "/partials/" . $layout . '.blade.php';

        $this->data['floatingSlotHasData']     = $this->slotHasData('floating');
        $this->data['aboveContentSlotHasData'] = $this->slotHasData('aboveContent');
        $this->data['belowContentSlotHasData'] = $this->slotHasData('belowContent');
        $this->data['slotHasData']             = $this->slotHasData('slot');


        if (!file_exists($file_path)) {
            $layout = 'full-width';
            $this->data['layout'] = $layout;
        };

        // Set the layout
        if ($layout) {
            $this->data['classList'][] = 'c-segment--' . $layout;
        }

        if (!empty($icon)) {
            $this->data['icon']['classList'][] = $this->getBaseClass('icon');
        }

        // If no link and exactly one button, use that button as link
        if (!$link && ($buttons && is_array($buttons) && count($buttons) === 1)) {
            $this->data['link'] = $buttons[0]['href'];
        }

        $this->data['imageClassList'] = [];
        $this->data['imageClassList'][] = $this->getBaseClass('image');

        if ($this->data['content'] == strip_tags($this->data['content'] ?? "", [])) {
            // Create paragraphs
            $paragraphs = preg_split("/\r\n|\n|\r/", $this->data['content'] ?? "");
            foreach ($paragraphs as &$part) {
                if (empty($part)) {
                    continue;
                }
                $part = "<p>{$part}</p>";
            }
            $this->data['content'] = implode('', $paragraphs);
        }

        // Remove padding
        if (!$paddingTop) {
            $this->data['classList'][] = 'u-padding__top--0';
            $this->data['imageClassList'][] = 'u-margin__top--0';
        }

        if (!$paddingBottom) {
            $this->data['classList'][] = 'u-padding__bottom--0';
            $this->data['imageClassList'][] = 'u-margin__bottom--0';
        }

        // Set text color
        if ($stretch) {
            $this->data['classList'][] = 'c-segment--stretch';
        }

        // Set text color
        if ($textColor) {
            $this->data['classList'][] = 'c-segment--text-' . $textColor;
        }

        // Height
        if ($height) {
            $this->data['classList'][] = 'c-segment--height-' . $height;
        }

        // Text Size
        if ($textSize) {
            $this->data['classList'][] = 'c-segment--text-' . $textSize;
        }

        // Text Alignment
        if ($textAlignment) {
            $this->data['classList'][] = 'c-segment--alignment-' . $textAlignment;
        }

        // Column reverse
        if ($reverseColumns) {
            $this->data['classList'][] = 'c-segment--reverse';
        }

        // Add overlay class
        if ($layout === 'full-width' && ($title || $content) && !empty($image)) {
            $this->data['classList'][] = 'c-segment' . '--has-overlay';
        }

        if (!empty($contentAlignment)) {
            $this->data['classList'][] =  $this->getBaseClass() . '--content-' . $contentAlignment;
        }

        // Handle background data (wrapper)
        if ($background) {
            if (preg_match('^#(?:[0-9a-fA-F]{3}){1,2}$^', $background)) {
                $this->data['attributeList']['style'] = 'background-color: ' . $background . ';';
            } else {
                $this->data['classList'][] = 'u-color__bg--' . $background;
            }
        }

        // Handle has image
        $this->data['hasImage'] = $hasImage = $this->hasImage($image);
        if(!$hasImage && !$hasPlaceholder) {
            $this->data['classList'][] = $this->getBaseClass('no-image', true);
        }

        //Handle date data 
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

        // Determine if dynamic link, determines if whole segment may be clickable
        $this->data['dynamicLink'] = empty($buttons) ? $link : false;
    }

    /**
     * Check if the image is set
     * 
     * @param mixed $image
     * 
     * @return bool
     */
    private function hasImage($image)
    {
        if(is_a($image, 'ComponentLibrary\Integrations\Image\Image')) {
            return !empty($image->getUrl());
        }elseif(is_string($image)) {
            return !empty($image);
        }
        return false;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'segment';
    }

    // -------------------------------------------------------------------------
    // SegmentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getLayout(): string
    {
        return $this->data['layout'] ?? 'full-width';
    }

    public function getTitle(): string|bool
    {
        return $this->data['title'] ?? false;
    }

    public function getContent(): string|bool
    {
        return $this->data['content'] ?? false;
    }

    public function getTextSize(): string
    {
        return $this->data['textSize'] ?? 'default';
    }

    public function getImage(): mixed
    {
        return $this->data['image'] ?? false;
    }

    public function getBackground(): string
    {
        return $this->data['background'] ?? false;
    }

    public function getBackgroundOverlay(): string
    {
        return $this->data['backgroundOverlay'] ?? false;
    }

    public function getTextColor(): string
    {
        return $this->data['textColor'] ?? 'dark';
    }

    public function getHeight(): string
    {
        return $this->data['height'] ?? 'content';
    }

    public function getPaddingTop(): bool
    {
        return $this->data['paddingTop'] ?? true;
    }

    public function getPaddingBottom(): bool
    {
        return $this->data['paddingBottom'] ?? true;
    }

    public function getTextAlignment(): string
    {
        return $this->data['textAlignment'] ?? 'top';
    }

    public function getReverseColumns(): bool
    {
        return $this->data['reverseColumns'] ?? false;
    }

    public function getOverlay(): string
    {
        return $this->data['overlay'] ?? false;
    }

    public function getStretch(): bool
    {
        return $this->data['stretch'] ?? false;
    }

    public function getButtons(): array
    {
        return $this->data['buttons'] ?? false;
    }

    public function getDate(): string|bool
    {
        return $this->data['date'] ?? false;
    }

    public function getMeta(): string|bool
    {
        return $this->data['meta'] ?? false;
    }

    public function getTags(): array|bool
    {
        return $this->data['tags'] ?? false;
    }

    public function getIcon(): array|bool
    {
        return $this->data['icon'] ?? false;
    }

    public function getIconBackgroundColor(): string
    {
        return $this->data['iconBackgroundColor'] ?? null;
    }

    public function getLink(): string|bool
    {
        return $this->data['link'] ?? false;
    }

    public function getHasPlaceholder(): bool
    {
        return $this->data['hasPlaceholder'] ?? true;
    }

    public function getLang(): array|bool
    {
        return $this->data['lang'] ?? (object) [];
    }
}
