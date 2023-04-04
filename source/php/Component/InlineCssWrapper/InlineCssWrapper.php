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
        if (!empty($styles)) {
            $this->data['attributeList']['style'] = self::buildInlineStyle($styles);
        }
    }
}
