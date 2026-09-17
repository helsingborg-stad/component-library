<?php

declare(strict_types=1);

use ComponentLibrary\Component\Footer\FooterData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'footer',
    view: 'footer.blade.php',
    data: FooterData::class,
    dependencies: ['sass' => ['components' => ['footer', 'typography']]],
);
