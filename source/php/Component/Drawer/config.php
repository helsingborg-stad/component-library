<?php
declare(strict_types=1);
use ComponentLibrary\Component\Drawer\DrawerData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'drawer', view: 'drawer.blade.php', data: DrawerData::class, dependencies: ['sass' => ['components' => ['button', 'icon', 'nav']]]);
