<?php
declare(strict_types=1);
use ComponentLibrary\Component\Collapsiblesearch\CollapsiblesearchData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'collapsiblesearch', view: 'collapsiblesearch.blade.php', data: CollapsiblesearchData::class, dependencies: ['sass' => ['components' => ['collapsible-search', 'button', 'icon']]]);
