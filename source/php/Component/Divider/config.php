<?php
declare(strict_types=1);
use ComponentLibrary\Component\Divider\DividerData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'divider', view: 'dropdown.blade.php', data: DividerData::class, dependencies: ['sass' => ['components' => ['divider']]]);
