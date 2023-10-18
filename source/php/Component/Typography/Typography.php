<?php

namespace ComponentLibrary\Component\Typography;

class Typography extends \ComponentLibrary\Component\BaseController
{
    private static $hasSeenH1       = null;
    private static $headingsContext = null;

    public function init() {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Set default
        $this->data['isPromotedHeading'] = false;

        //If this is the first heading of the page, promote it to h1
        if (substr($element, 0, 2) == 'h1') {
            self::$hasSeenH1 = true; 
        } 

        if (substr($element, 0, 1) == 'h') {
            $this->data['element'] = $this->setMaxHeading($element);
        }
  
        if ($autopromote === true && !self::$hasSeenH1) {
            if (in_array($element, ['h1', 'h2', 'h3'])) {
                $this->data['isPromotedHeading'] = true;
                $this->data['element'] = 'h1';
                self::$hasSeenH1 = true;
            }
        }

        //Variant
        $this->data['classList'][] = $this->getBaseClass() . "__variant--" . $variant;
    }

    private function setMaxHeading($element) {
        $headingsLevel = intval(substr($element, 1, 2));
        if (self::$headingsContext === null) {
            if ($element !== 'h2' && $element !== 'h1') {
                $headingsLevel = 2;
                self::$headingsContext = 2;
                return 'h2';
            } 
        } else {
            if (self::$headingsContext == $headingsLevel && $headingsLevel != 1) {
                self::$headingsContext = $headingsLevel;
            } elseif (self::$hasSeenH1 && $headingsLevel == 1) {
                self::$headingsContext = 2;
                return 'h2';
            } elseif ($headingsLevel - self::$headingsContext > 1) {
                self::$headingsContext++;
                return 'h' . strval(self::$headingsContext);
            } else {
                self::$headingsContext = $headingsLevel;
            } 
        }
        return $element;
    }
}
