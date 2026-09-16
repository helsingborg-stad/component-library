<?php
declare(strict_types=1);
use ComponentLibrary\Component\MegaMenu\MegaMenuData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'megaMenu', view: 'megaMenu.blade.php', data: MegaMenuData::class, dependencies: ['sass' => ['components' => ['menu', 'icon']]]);
