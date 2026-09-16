<?php
declare(strict_types=1);
use ComponentLibrary\Component\Fab\FabData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'fab', view: 'fab.blade.php', data: FabData::class, dependencies: ['sass' => ['components' => ['fab', 'button', 'icon']]]);
