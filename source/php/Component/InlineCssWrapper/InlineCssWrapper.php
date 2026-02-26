<?php

namespace ComponentLibrary\Component\InlineCssWrapper;

/**
 * Class InlineCssWrapper
 * @package ComponentLibrary\Component\InlineCssWrapper
 */
class InlineCssWrapper extends \ComponentLibrary\Component\BaseController implements InlineCssWrapperInterface
{
    public function init()
    {   
        extract($this->data);
        if (!empty($styles)) {
            $this->data['attributeList']['style'] = self::buildInlineStyle($styles);
        }
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'inlineCssWrapper';
    }

    // -------------------------------------------------------------------------
    // InlineCssWrapperInterface — generated getters
    // -------------------------------------------------------------------------

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'div';
    }

    public function getStyles(): array
    {
        return $this->data['styles'] ?? [];
    }
}
