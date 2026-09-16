<?php
declare(strict_types=1);
use ComponentLibrary\Component\Dropdown\DropdownData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'dropdown', view: 'dropdown.blade.php', data: DropdownData::class, dependencies: ['sass' => ['components' => ['dropdown']]]);
