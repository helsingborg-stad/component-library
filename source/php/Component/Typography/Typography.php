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
        $this->data['originalElement'] = $element;
        $this->data['element'] = $element;

        if ($useHeadingsContext && substr($element, 0, 1) == 'h') {
            $this->data['element'] = $this->setMaxHeading($element);
        }

        //If this is the first heading of the page, promote it to h1
        if ($useHeadingsContext && !self::$hasSeenH1 && substr($this->data['element'], 0, 2) == 'h1') {
            self::$hasSeenH1 = true; 
        } 
  
        if ($useHeadingsContext && $autopromote === true && !self::$hasSeenH1) {
            if (in_array($element, ['h1', 'h2', 'h3'])) {
                $this->data['isPromotedHeading'] = true;
                $this->data['element'] = 'h1';
                self::$hasSeenH1 = true;
                self::$headingsContext = 1;
            }
        }

        $this->data['hasSeenH1'] = self::$hasSeenH1;
        
        //Variant
        $this->data['classList'][] = $this->getBaseClass() . "__variant--" . $this->getVariant($variant);
    }

    private function getVariant($variant) {
        $element = $this->data['element'];
        if (!$variant) {
            return $element;
        }
        
        
        if (in_array($element, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])) {
            if (in_array($variant, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])) {
                return $variant;
            } 

            trigger_error(
                sprintf(
                    'Element "%s" and variant "%s" cannot be combined. Heading elements must use a heading variant.',
                    $element,
                    $variant
                ),
                E_USER_WARNING
            );

            return $element;
        }

        return 'p';
    }

    private function setMaxHeading($element) {
        $headingsLevel = intval(substr($element, 1, 2));
        if (self::$headingsContext === null) {
            if ($element !== 'h1') {
                $headingsLevel = 2;
                self::$headingsContext = 2;
                return 'h2';
            } else {
                self::$headingsContext = 1;
                self::$hasSeenH1 = true;
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
