<?php

namespace ComponentLibrary\Component\Video;

class Video extends \ComponentLibrary\Component\BaseController implements VideoInterface  
{
    
    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Controls
        if($hasControls) {
            $this->data['controls'] = "controls"; 
        } else {
            $this->data['controls'] = ""; 
        }

        //Muted
        if($isMuted) {
            $this->data['muted'] = "muted"; 
        } else {
            $this->data['muted'] = ""; 
        }

        //Autoplay
        if($shouldAutoplay) {
            $this->data['autoplay'] = "autoplay"; 
        } else {
            $this->data['autoplay'] = ""; 
        }
        
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'video';
    }

    // -------------------------------------------------------------------------
    // VideoInterface — generated getters
    // -------------------------------------------------------------------------

    public function getHasControls(): bool
    {
        return $this->data['hasControls'] ?? true;
    }

    public function getIsMuted(): bool
    {
        return $this->data['isMuted'] ?? false;
    }

    public function getShouldAutoplay(): bool
    {
        return $this->data['shouldAutoplay'] ?? false;
    }

    public function getErrorMessage(): string
    {
        return $this->data['errorMessage'] ?? 'This component is not supported by your browser.';
    }

    public function getFormats(): array
    {
        return $this->data['formats'] ?? [];
    }

    public function getHeight(): int
    {
        return $this->data['height'] ?? 300;
    }

    public function getWidth(): int
    {
        return $this->data['width'] ?? 600;
    }

    public function getSubtitles(): bool
    {
        return $this->data['subtitles'] ?? false;
    }
}
