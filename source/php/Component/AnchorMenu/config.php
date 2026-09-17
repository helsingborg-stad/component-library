<?php

declare(strict_types=1);

use ComponentLibrary\Component\AnchorMenu\AnchorMenuData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'anchorMenu',
    view: 'anchorMenu.blade.php',
    data: AnchorMenuData::class,
    dependencies: ['sass' => ['components' => ['link', 'group', 'icon']]],
);
