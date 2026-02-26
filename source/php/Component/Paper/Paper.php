<?php

namespace ComponentLibrary\Component\Paper;

class Paper extends \ComponentLibrary\Component\BaseController implements PaperInterface 
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->compParams = [
            'padding' 	=> $padding ?? false,
            'transparent' 	=> $transparent ?? false
        ];

        $this->setData();
    }

    /**
     * Set data for paper
     */
    public function setData(){

        //Create padding && transparent modifier
        $this->data['classList']['padding'] = (is_numeric($this->compParams['padding'])) ?
            $this->getBaseClass() . "--padding-" . $this->compParams['padding'] : '';

        $this->data['classList']['transparent'] = ($this->compParams['transparent']) ?
            $this->getBaseClass() . "--transparent" : '';

    }

    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'paper';
    }

    // -------------------------------------------------------------------------
    // PaperInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlot(): string
    {
        return $this->data['slot'] ?? '';
    }

    public function getPadding(): bool
    {
        return $this->data['padding'] ?? false;
    }

    public function getTransparent(): bool
    {
        return $this->data['transparent'] ?? false;
    }
}
