<?php

namespace ComponentLibrary\Component\Collection;

class Collection extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['slotHasData'] = $this->slotHasData('slot');

        //Modifiers
        if($bordered) {
            $this->data['classList'][] = $this->getBaseClass() . '--bordered'; 
        }

        if($compact) {
            $this->data['classList'][] = $this->getBaseClass() . '--compact'; 
        }

        if($sharp) {
            $this->data['classList'][] = $this->getBaseClass() . '--sharp'; 
        }

        if($sharpBottom) {
            $this->data['classList'][] = $this->getBaseClass() . '--sharp-bot'; 
        }

        if($sharpTop) {
            $this->data['classList'][] = $this->getBaseClass() . '--sharp-top'; 
        }

        if($unbox) {
            $this->data['classList'][] = $this->getBaseClass() . '--unbox'; 
        }

        //Input list handling
        if(!empty($list) && is_array($list)) {
            foreach($this->data['list'] as &$item) {
                
                //Handle non multidimensional input
                if(is_string($item)) {
                    $item = array(
                        'content' => $item,
                    ); 
                }

                //Set defaults.
                $item = array_merge(
                    [
                        'title' => false,
                        'content' => false, 
                        'link' => false
                    ],
                    $item
                );
            }
        }
    }
}