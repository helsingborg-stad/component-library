<?php

namespace ComponentLibrary\Component\Card;

/**
 * Class Card
 * @package ComponentLibrary\Component\Card
 */
class Card extends \ComponentLibrary\Component\BaseController
{
	public function init()
	{
		//Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['collpaseID'] = uniqid();

		$this->data['classList'][] = $this->getBaseClass() . '--' . $color; 

		if(isset($image['padded']) && $image['padded']){
			$this->data['paddedImage'] = $this->getBaseClass() . '__image-background--padded'; 	
		} 

		if($imageFirst){
			$this->data['classList'][] = $this->getBaseClass() . '--image-first'; 
		} 

		if($hasAction){
			$this->data['classList'][] = $this->getBaseClass() . '--action'; 
		}

        if($hasFooter || $tags || $buttons){
			$this->data['classList'][] = $this->getBaseClass() . '--has-footer'; 
		}

		if($collapsible && $content){
			$this->data['collapsible'] = $this->getBaseClass() . '--collapse';
		}
		
		if($image && !isset($image['backgroundColor'])) {
			$this->data['image']['backgroundColor'] = 'white';
		}

		if($image && !isset($image['src']) || (isset($image['src']) && empty($image['src']))) {
			$this->data['image'] = false;
		}

		if($link) {
			$this->data['componentElement'] = "a"; 
		} else {
			$this->data['componentElement'] = "div"; 
        }

        if ($ratio) {
            $ratio = str_replace(":", "-", $ratio);
            $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . $ratio;
        }
    }
}
