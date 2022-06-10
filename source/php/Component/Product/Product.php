<?php

namespace ComponentLibrary\Component\Product;

class Product extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        if (!$id) {
            $this->data['id'] = uniqid();
        }

        if (isset($image['padded']) && $image['padded']) {
            $this->data['paddedImage'] = 'c-card__image-background--padded';
        }
    }
}
