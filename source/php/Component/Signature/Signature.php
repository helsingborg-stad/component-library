<?php

namespace ComponentLibrary\Component\Signature;

class Signature extends \ComponentLibrary\Component\BaseController
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass() . "--space-" . count(array_filter([$updated, $published])); 

        //Component element
        if($link) {
            $this->data['componentElement'] = "a"; 
            $this->data['attributeList'] = ['href' => $link]; 
		} else {
			$this->data['componentElement'] = "div"; 
        }

        if (empty($avatar) && empty($placeholderAvatar)) {
            $this->data['classList'][] = $this->getBaseClass('no-avatar', true);
        }

        //Labels
        $this->data['label'] = (object) [
            'publish' => $publishedLabel ?: false,
            'updated' => $updatedLabel ?: false
        ]; 

    }
}
