<?php

declare(strict_types=1);

use ComponentLibrary\Component\Iframe\IframeData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'iframe',
    view: 'iframe.blade.php',
    data: IframeData::class,
    dependencies: ['sass' => ['components' => ['button', 'typography', 'acceptance']]],
);
