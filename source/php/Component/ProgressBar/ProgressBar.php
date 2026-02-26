<?php

namespace ComponentLibrary\Component\ProgressBar;

class ProgressBar extends \ComponentLibrary\Component\BaseController implements ProgressBarInterface  
{
    
    public function init() {

        //Extract array for easy access (fetch only)
        extract($this->data);

        $this->data['progressionValue'] = 'width:' . $value . '%;';

        if($isCancelled) {
            $this->data['classList'][] = $this->getBaseClass() . '--cancelled';
        }
     
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'progressBar';
    }

    // -------------------------------------------------------------------------
    // ProgressBarInterface — generated getters
    // -------------------------------------------------------------------------

    public function getIsCancelled(): bool
    {
        return $this->data['isCancelled'] ?? false;
    }

    public function getValue(): int
    {
        return $this->data['value'] ?? 0;
    }
}
