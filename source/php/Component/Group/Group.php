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

        if (!empty($fluidGrid)) {
            $this->data['containerAware'] = true;
            $this->data['classList'][] = $this->getBaseClass('fluid-grid', true);
        }

        if ($direction == "vertical") {
            $this->data['classList'][] = $this->getBaseClass() . "--vertical";
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--horizontal";
        }

        if(!empty($justifyContent)) {
            $this->data['classList'][] = $this->getBaseClass() . "--justify-content-" . $justifyContent;      
        }
        
        if(!empty($gap)) {
            $this->data['classList'][] = $this->getBaseClass('gap-' . $gap, true);      
        }
        
        if(!empty($alignItems)) {
            $this->data['classList'][] = $this->getBaseClass() . "--align-items-" . $alignItems;      
        }

        if(!empty($alignContent)) {
            $this->data['classList'][] = $this->getBaseClass() . "--align-content-" . $alignContent;      
        }

        if(!empty($display)) {
            $this->data['classList'][] = $this->getBaseClass() . "--display-" . $display;      
        }

        if(!empty($wrap)) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-wrap-" . $wrap;      
        }

        if($flexGrow) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-grow";
        }

        if(!$flexShrink) {
            $this->data['classList'][] = $this->getBaseClass() . "--flex-shrink-none";
        }

    }

}
