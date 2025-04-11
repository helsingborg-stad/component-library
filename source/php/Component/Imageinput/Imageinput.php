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

        //Remove any filetype in accept mime array, that isent an image
        $this->data['accept'] = array_filter($this->data['accept'], function($mime) {
            return str_contains($mime, 'image');
        });

        //Map all data to data key (passtrough component)
        $this->data['data'] = $passDownData;
    }
}
