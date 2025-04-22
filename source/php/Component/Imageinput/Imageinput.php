<?php

namespace ComponentLibrary\Component\Imageinput;

class Imageinput extends \ComponentLibrary\Component\BaseController
{
    private $unpassable = ['class', 'attribute'];

    public function init()
    {
        //Remove keys that is not passable to child component
        $passDownData = $this->data ?? []; 
        foreach ($this->unpassable as $key) {
            unset($passDownData[$key]);
        }
        
        $this->data['accept'] = (function ($accept) {
            is_string($accept) && $accept = explode(',', $accept);
            $accept = (array) $accept;
            $accept = array_filter($accept, fn($mime) => str_contains($mime, 'image'));
        
            return implode(',', $accept);
        })($this->data['accept'] ?? []);

        //Map all data to data key (passtrough component)
        $this->data['passDownData'] = $passDownData;
    }
}
