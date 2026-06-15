<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Card__image;

/**
 * Class Card__image
 *
 * @package ComponentLibrary\Component\Card__image
 */
class Card__image extends \ComponentLibrary\Component\BaseController
{
    /**
     * Initialize the card image component.
     *
     * @return void
     */
    public function init()
    {
        $this->data['baseClass'] = 'c-card__image-container';
    }
}
