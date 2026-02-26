<?php

namespace ComponentLibrary\Component\Calendar;

class Calendar extends \ComponentLibrary\Component\BaseController implements CalendarInterface
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);
		$attributes = [
			'eventsUrl' => $eventsUrl,
			'bookingUrl' =>  $bookingUrl,
			'weekStart' => $weekStart,
			'size' => $size,
			'color' => $color,
			'js-toggle-class' => 'ad'
		];

		$this->addToAttributeList($attributes);
		$this->setColor($color);
		$this->data['id'] = uniqid("", true);
		$this->data['toggleId'] = uniqid("", true);
	}

	private function addToAttributeList($attributeList)
    {
		foreach($attributeList as $key => $value){
			$this->data['attributeList'][$key] = $value;	
		}
	} 

	private function setColor($color){
		$this->data['classList'][] = $this->getBaseClass() . '--' . $color;
	}
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'calendar';
    }

    // -------------------------------------------------------------------------
    // CalendarInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getSize(): string
    {
        return $this->data['size'] ?? 'large';
    }

    public function getGet(): string
    {
        return $this->data['get'] ?? '';
    }

    public function getSet(): string
    {
        return $this->data['set'] ?? '';
    }

    public function getColor(): string
    {
        return $this->data['color'] ?? 'default';
    }

    public function getWeekStart(): string
    {
        return $this->data['weekStart'] ?? 'Monday';
    }
}
