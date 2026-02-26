<?php

namespace ComponentLibrary\Component\Product;

class Product extends \ComponentLibrary\Component\BaseController implements ProductInterface
{
    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        if (!$id) {
            $this->data['id'] = $this->sanitizeIdAttribute(uniqid());
        }

        if (isset($image['padded']) && $image['padded']) {
            $this->data['paddedImage'] = 'c-card__image-background--padded';
        }

        if ($featured) {
            $this->data['classList'][] = 'c-product--featured';
        }

        if ($button) {
            if (!isset($button['color'])) {
                $this->data['button']['color'] = $backgroundColor;
            }
            $this->data['button']['classList'][] = 'c-product__button';
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'product';
    }

    // -------------------------------------------------------------------------
    // ProductInterface — generated getters
    // -------------------------------------------------------------------------

    public function getHeading(): string
    {
        return $this->data['heading'] ?? '';
    }

    public function getBackgroundColor(): string
    {
        return $this->data['backgroundColor'] ?? 'primary';
    }

    public function getImage(): bool
    {
        return $this->data['image'] ?? false;
    }

    public function getPrices(): array
    {
        return $this->data['prices'] ?? [];
    }

    public function getCurrencyFirst(): bool
    {
        return $this->data['currencyFirst'] ?? false;
    }

    public function getLabel(): string
    {
        return $this->data['label'] ?? '';
    }

    public function getMeta(): string
    {
        return $this->data['meta'] ?? '';
    }

    public function getBulletPoints(): array
    {
        return $this->data['bulletPoints'] ?? [];
    }

    public function getButton(): array
    {
        return $this->data['button'] ?? [];
    }

    public function getFeatured(): bool
    {
        return $this->data['featured'] ?? false;
    }
}
