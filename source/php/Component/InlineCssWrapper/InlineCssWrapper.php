<?php

namespace ComponentLibrary\Component\InlineCssWrapper;

/**
 * Class InlineCssWrapper
 * @package ComponentLibrary\Component\InlineCssWrapper
 */
class InlineCssWrapper extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {   
        extract($this->data);
        $inlineStyles = $this->buildInlineCss($styles);

        $this->data['attributeList']['style'] = $inlineStyles;
    }

    private function buildInlineCss($styles) {
        $stylesString = '';
        if (empty($styles)) {
            return false;
        }

        foreach ($styles as $style => $value) {
            $stylesString .= $style . ': ' . $value . ';';
        }

        $stylesString = preg_replace_callback('/([A-Z])/', function($matches) {
            return '-' . strtolower($matches[0]);
        }, $stylesString);
        
        return $stylesString;
    }
}
