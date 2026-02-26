<?php

namespace ComponentLibrary\Component\Tile;

class Tile extends \ComponentLibrary\Component\BaseController implements TileInterface
{
    public function init()
    {
		//Extract array for eazy access (fetch only)
        extract($this->data);

        $this->setSize($width, $height);
        $this->setBackgroundImage($backgroundImage);
    }
    
    private function setSize($width, $height)
    {
        $this->data['classList'][] = $this->getBaseClass() . '__item--width' . $width;
        $this->data['classList'][] = $this->getBaseClass() . '__item--height' . $height;
    }

    private function setBackgroundImage($img) {
        if ($img != "")
            $this->data['attributeList']['style'] = 'background-image: url(' . $img . ')';
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'tile';
    }

    // -------------------------------------------------------------------------
    // TileInterface — generated getters
    // -------------------------------------------------------------------------

    public function getWidth(): string
    {
        return $this->data['width'] ?? '';
    }

    public function getHeight(): string
    {
        return $this->data['height'] ?? '';
    }

    public function getBackgroundImage(): string
    {
        return $this->data['backgroundImage'] ?? '';
    }
}
