<?php

namespace ComponentLibrary\Component\Group;

/**
 * Class Group
 * @package ComponentLibrary\Component\Group
 */
class Group extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if ($direction == "vertical") {
            $this->data['classList'][] = $this->getBaseClass() . "--vertical";
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--horizontal";
        }

        if(isset($justify)) {
            $this->data['classList'][] = $this->getBaseClass() . "--justify-content-" . $justify;      
        }
        
        if(isset($alignItems)) {
            $this->data['classList'][] = $this->getBaseClass() . "--align-items-" . $alignItems;      
        }

        if(isset($alignContent)) {
            $this->data['classList'][] = $this->getBaseClass() . "--align-content-" . $alignContent;      
        }

        if(isset($flex)) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-" . $flex;      
        }

        if(isset($wrap)) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-wrap-" . $wrap;      
        }

    }

}
