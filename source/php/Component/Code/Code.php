<?php

namespace ComponentLibrary\Component\Code;

class Code extends \ComponentLibrary\Component\BaseController implements CodeInterface  
{
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Escape
        if($escape) {
            $this->data['slot'] = htmlentities($slot); 
        }

        $language = ($language) ? $language : 'php';

    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'code';
    }

    // -------------------------------------------------------------------------
    // CodeInterface — generated getters
    // -------------------------------------------------------------------------

    public function getContent(): string
    {
        return $this->data['content'] ?? 'Undocumented code...';
    }

    public function getSlot(): string
    {
        return $this->data['slot'] ?? 'echo \'Whoops, theres no code here. Where is it?\'';
    }

    public function getLanguage(): string
    {
        return $this->data['language'] ?? 'php';
    }

    public function getEscape(): bool
    {
        return $this->data['escape'] ?? false;
    }

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getPreTagElement(): string
    {
        return $this->data['preTagElement'] ?? 'pre';
    }
}
