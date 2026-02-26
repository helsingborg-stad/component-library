<?php

namespace ComponentLibrary\Component\Hero;

class Hero extends \ComponentLibrary\Component\BaseController implements HeroInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
        
        $this->data['contentStyles'] = "";
        $this->data['attributeList']['aria-label'] = $ariaLabel;
        $this->data['linkArgs'] = null;
        $this->data['buttonArgs'] = null;

        if ($stretch) {
            $this->data['classList'][] = $this->getBaseClass() . "--stretch";
        }

        if ($video) {
            $this->data['classList'][] = $this->getBaseClass() . "--video";
        }

        if (!$video) {
            $this->data['classList'][] = $this->getBaseClass() . "--image";
        }

        $this->data['classList'][] = $this->getBaseClass() . '--' . $heroView;

        //Create image style tag
        $this->data['imageStyle'] = [];
        $this->data['imageStyleString'] = "";

        //Add image to image styles
        if ($image) {
            $this->data['image'] = $image;
        }

        if ($video) {
            $this->data['videoUrl'] = $video;
        }

        //Ratio
        if ($size) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $size;
        }

        if (in_array($contentAlignmentVertical, ["top", "center"])) {
            $this->data['classList'][] = $this->getBaseClass() . "--content-vertical__" . $contentAlignmentVertical;
        }
        
        if (in_array($contentAlignmentHorizontal, ["center", "right"])) {
            $this->data['classList'][] = $this->getBaseClass() . "--content-horizontal__" . $contentAlignmentHorizontal;
        }

        if (($textAlignmentClass = $this->getTextAlignmentClass($textAlignment))) {
            $this->data['classList'][] = $textAlignmentClass;
        }

        if (isset($contentApplyRoundedCorners) && $contentApplyRoundedCorners === true) {
            $this->data['classList'][] = $this->getBaseClass() . '--apply-rounded-corners';
        }
        
        if (isset($contentApplyShadows) && $contentApplyShadows === true) {
            $this->data['classList'][] = $this->getBaseClass() . '--apply-shadows';
        }

        if (!empty($contentBackgroundColor) &&  ($title || $paragraph || $byline || $meta)) {
            $this->data['overlay'] = false;
            $this->data['classList'][] = $this->getBaseClass() . '--has-content-background-color';
            $this->data['contentStyles'] .= "background-color: $contentBackgroundColor;";
        }

        if (!empty($textColor)) {
            $this->data['classList'][] = $this->getBaseClass() . "--has-contrast-color";
            $this->data['contentStyles'] .= "color: $textColor;";
        }

        //Overlay
        if (empty($contentBackgroundColor) && ($title || $paragraph || $byline || $meta) && $this->data['heroView'] !== 'callToActions') {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay';
            $this->data['overlay'] = true;
        } else {
            $this->data['overlay'] = false;
        }

        if($meta) {
            $this->data['meta'] = $meta;
            $this->data['classList'][] = $this->getBaseClass() . '--meta';
        }

        if ($animation) {
            $this->data['classList'][] = $this->getBaseClass() . '--' . $animation;
            $this->data['classList'][] = $this->getBaseClass() . '--has-animation';
            $this->data['hasAnimation'] = true;
        } else {
            $this->data['hasAnimation'] = false;
        }

        if ($background) {
            $this->data['background'] = 'background:' . $background . ';';
        }

        // Check if button args and only single button
        if (!empty($buttonArgs) && is_array($buttonArgs) && isset($buttonArgs['href'])) {
            if (!empty($buttonArgs['href']) && isset($buttonArgs['text']) && !empty($buttonArgs['text'])) {
                $this->data['buttonArgs'] = $buttonArgs;
            }

            if (!empty($buttonArgs['href']) && (!isset($buttonArgs['text']) || empty($buttonArgs['text']) )) {
                $this->data['linkArgs'] = array(
                    'href' => $buttonArgs['href'],
                    'classList' => ["{$this->getBaseClass()}__content--link"]
                );
            }
        } else {
            $this->data['buttons'] = $buttonArgs;
        }

        $this->data['customHeroData'] = $this->handleCustomDataFunc($heroView, $customHeroData);

        if ($customHeroData && array_key_exists('modifiers', $customHeroData)) {
            if (!is_array($customHeroData['modifiers'])) {
                trigger_error(
                    sprintf(
                        'customHeroData["modifiers"] should be an array.',
                        print_r($this, true)
                    ),
                    E_USER_WARNING
                );
                return;
            } 
            foreach ($customHeroData['modifiers'] as $modifier) {
                $this->data['classList'][] = $this->getBaseClass() . '--' . $modifier;

                if ($modifier === "overflow") {
                    $this->data['background'] = $background ? 'background: ' . $background . ';' : 
                    ($image ? 'background-image:url(' . $image . ')' . ';' : '');
                }
            }
        }

        $this->data['hasContent'] = $this->hasContent();
        $this->data['contentStyles'] = $this->sanitizeInlineCss($this->data['contentStyles']);

    }
    
    private function getTextAlignmentClass(string $textAlignment)
    {
        if (!in_array($textAlignment, ["center", "right"])) {
            return false;
        }

        return $this->getBaseClass() . '--text-align__' . $textAlignment;
    }

    private function handleCustomDataFunc($heroView, $customHeroData) {
        if (method_exists($this, $heroView)) {
            return $this->$heroView($customHeroData);
        } 
        
        return false;
    }

    private function twoColumn($customHeroData) {
        $data['contentSlotHasData'] = $this->slotHasData('content');

        return $data;
    }

    private function callToActions($customHeroData) {
        if ($customHeroData['mediaFirst'] === true) {
            $this->data['classList'][] = $this->getBaseClass() . '--media-first';
        }

        return $customHeroData;
    }

    private function hasContent(): bool
    {
        $stringEmpty = fn ($value): bool => empty(trim($value ?? ""));

        if (!$stringEmpty($this->data['meta'])) return true;
        if (!$stringEmpty($this->data['title'])) return true;
        if (!$stringEmpty($this->data['byline'])) return true;
        if (!$stringEmpty($this->data['paragraph'])) return true;
        if (!empty($this->data['buttonArgs'])) return true;

        return false;
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'hero';
    }

    // -------------------------------------------------------------------------
    // HeroInterface — generated getters
    // -------------------------------------------------------------------------

    public function getImage(): mixed
    {
        return $this->data['image'] ?? false;
    }

    public function getImageFocus(): object
    {
        return $this->data['imageFocus'] ?? (object) [];
    }

    public function getVideo(): string
    {
        return $this->data['video'] ?? false;
    }

    public function getSize(): string
    {
        return $this->data['size'] ?? 'normal';
    }

    public function getTitle(): string
    {
        return $this->data['title'] ?? '';
    }

    public function getByline(): string
    {
        return $this->data['byline'] ?? '';
    }

    public function getParagraph(): string
    {
        return $this->data['paragraph'] ?? '';
    }

    public function getStretch(): bool
    {
        return $this->data['stretch'] ?? false;
    }

    public function getAnimation(): string
    {
        return $this->data['animation'] ?? false;
    }

    public function getAriaLabel(): string
    {
        return $this->data['ariaLabel'] ?? 'Hero';
    }

    public function getHeroView(): string
    {
        return $this->data['heroView'] ?? 'default';
    }

    public function getCustomHeroData(): array
    {
        return $this->data['customHeroData'] ?? false;
    }

    public function getMeta(): string
    {
        return $this->data['meta'] ?? false;
    }

    public function getBackground(): string
    {
        return $this->data['background'] ?? false;
    }

    public function getTextColor(): string
    {
        return $this->data['textColor'] ?? '';
    }

    public function getTextAlignment(): string
    {
        return $this->data['textAlignment'] ?? 'left';
    }

    public function getContentBackgroundColor(): string
    {
        return $this->data['contentBackgroundColor'] ?? '';
    }

    public function getContentAlignmentVertical(): string
    {
        return $this->data['contentAlignmentVertical'] ?? 'bottom';
    }

    public function getContentAlignmentHorizontal(): string
    {
        return $this->data['contentAlignmentHorizontal'] ?? 'left';
    }

    public function getContentApplyRoundedCorners(): bool
    {
        return $this->data['contentApplyRoundedCorners'] ?? true;
    }

    public function getContentApplyShadows(): bool
    {
        return $this->data['contentApplyShadows'] ?? true;
    }

    public function getButtonArgs(): array
    {
        return $this->data['buttonArgs'] ?? [];
    }

    public function getPoster(): bool
    {
        return $this->data['poster'] ?? false;
    }

    public function getOverlay(): string
    {
        return $this->data['overlay'] ?? '';
    }

    public function getContent(): string|bool
    {
        return $this->data['content'] ?? false;
    }
}
