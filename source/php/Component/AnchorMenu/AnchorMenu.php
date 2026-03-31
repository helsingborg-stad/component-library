<?php

namespace ComponentLibrary\Component\AnchorMenu;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;

/**
 * Class AnchorMenu
 * @package ComponentLibrary\Component\AnchorMenu
 * @deprecated This component is deprecated and will be removed.
 */
class AnchorMenu extends \ComponentLibrary\Component\BaseController
{
    public function __construct($data, CacheInterface $cache, TagSanitizerInterface $tagSanitizer)
    {
        trigger_error('The AnchorMenu component is deprecated and will be removed.', E_USER_DEPRECATED);
        return parent::__construct($data, $cache, $tagSanitizer);
    }

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['menuItems'] = $menuItems;
    }
}
