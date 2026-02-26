<?php

namespace ComponentLibrary\Component\Slider__item;

class Slider__item extends \ComponentLibrary\Component\BaseController implements Slider__itemInterface
{
    private array $slotMapping = [
        'slot' => 'slotHasData'
    ];

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData'] = $this->slotHasData('slot');

        $this->data['classListDesktop'] = $this->getBaseClass() . "__image";
        $this->data['classList'][] = 'splide__slide';

        if (!empty($containerColor)) {
            $this->data['classList'][] = 'u-color__bg--' . $containerColor;
        }

        if (!empty($textAlignment)) {
            $this->data['classList'][] = $this->getBaseClass() . "--text-align-" . $textAlignment;
        }

        if (!empty($textColor)) {
            $this->data['classList'][] = $this->getBaseClass() . "--text-" . $textColor;
        }

        if (!empty($layout)) {
            $this->data['classList'][] = $this->getBaseClass() . "--layout-" . $layout;
        }

        $this->data['showContainer'] = false;
        if (!empty($title) || !empty($subTitle) ||!empty($text) || !empty($bottom) || !empty($cta)) {
            $this->data['showContainer'] = true;
        }

        if ($overlay && ($text || $title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--overlay-' . $overlay;
        }

        if (!empty($alt)) {
            $this->data['alt'] = $alt;
        }

        if ($heroStyle) {
            $this->data['classList'][] = $this->getBaseClass() . "--hero";
        }

        if ($video) {
            $this->data['attributeList']['data-js-slider-video'] = $video;
        }

        foreach ($this->slotMapping as $slot => $hasDataKey) {
            $this->data[$hasDataKey] = $this->slotHasData($slot);
            if ($this->data[$hasDataKey] && $link) {
                $this->data[$slot] = $this->tagSanitizer->removeATags((string) $this->data[$slot]);
            }
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'slider__item';
    }

    // -------------------------------------------------------------------------
    // Slider__itemInterface — generated getters
    // -------------------------------------------------------------------------

    public function getTitle(): string|bool
    {
        return $this->data['title'] ?? '';
    }

    public function getText(): string|bool
    {
        return $this->data['text'] ?? '';
    }

    public function getCta(): array|bool
    {
        return $this->data['cta'] ?? [];
    }

    public function getImage(): mixed
    {
        return $this->data['image'] ?? false;
    }

    public function getVideo(): bool|string
    {
        return $this->data['video'] ?? false;
    }

    public function getAlt(): string
    {
        return $this->data['alt'] ?? '';
    }

    public function getLink(): string|bool
    {
        return $this->data['link'] ?? false;
    }

    public function getLinkDescription(): string
    {
        return $this->data['linkDescription'] ?? '';
    }

    public function getLayout(): string
    {
        return $this->data['layout'] ?? 'bottom';
    }

    public function getTheme(): string
    {
        return $this->data['theme'] ?? 'base';
    }

    public function getContainerColor(): string
    {
        return $this->data['containerColor'] ?? '';
    }

    public function getHeroStyle(): string
    {
        return $this->data['heroStyle'] ?? false;
    }

    public function getTextAlignment(): string
    {
        return $this->data['textAlignment'] ?? '';
    }

    public function getOverlay(): string
    {
        return $this->data['overlay'] ?? 'none';
    }

    public function getSlot(): bool|string
    {
        return $this->data['slot'] ?? false;
    }

    public function getBottom(): bool|string
    {
        return $this->data['bottom'] ?? false;
    }
}
