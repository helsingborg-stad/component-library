<?php
declare(strict_types=1);
use ComponentLibrary\Component\Popover\PopoverData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'popover', view: 'popover.blade.php', data: PopoverData::class, dependencies: ['sass' => ['components' => ['card', 'typography', 'icon', 'signature']]]);
