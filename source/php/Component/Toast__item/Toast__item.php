<?php

namespace ComponentLibrary\Component\Toast__item;

class Toast__item extends \ComponentLibrary\Component\BaseController
{
    private $unpassable = ['class', 'attribute'];

    public function init()
    {
        //Remove keys that is not passable to child component
        $passDownData = $this->data ?? []; 
        foreach ($this->unpassable as $key) {
            unset($passDownData[$key]);
        }

        //Map all data to data key (passtrough component)
        $this->data['data'] = $passDownData;

        //Add parent component class to classlist of child component
        $this->data['data']['classList'][] = $this->getBaseClass();

        //Add dismissable class to classlist of child component
        if($this->data['data']['dismissable'] ?? false) {
            $this->data['data']['classList'][] = $this->getBaseClass('dismissable', true);
        }

        //Indicate that this item has an action
        if($this->data['data']['action'] ?? false) {
            $this->data['data']['classList'][] = $this->getBaseClass('has-action', true);
        }
    }
}
