<?php

namespace ComponentLibrary\Component\Logotypegrid;

class Logotypegrid extends \ComponentLibrary\Component\BaseController implements LogotypegridInterface
{

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Make obj, and fill missing params.
        if (is_array($this->data['items']) && !empty($this->data['items'])) {
            foreach ($this->data['items'] as &$item) {
                $item = (object) array_merge([
                    'url' => false,
                    'src' => false,
                    'alt' => ''
                ], $item);
            }
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'logotypegrid';
    }

    // -------------------------------------------------------------------------
    // LogotypegridInterface — generated getters
    // -------------------------------------------------------------------------

    public function getItems(): array
    {
        return $this->data['items'] ?? [];
    }
}
