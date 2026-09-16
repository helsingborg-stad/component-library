<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\AnchorMenu;

/** Typed input contract for the AnchorMenu component. */
final class AnchorMenuData
{
    public function __construct(public array $menuItems = [])
    {
    }
}
