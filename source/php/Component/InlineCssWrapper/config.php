<?php

declare(strict_types=1);

use ComponentLibrary\Component\InlineCssWrapper\InlineCssWrapperData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'inlineCssWrapper',
    view: 'inlineCssWrapper.blade.php',
    data: InlineCssWrapperData::class,
    dependencies: [
        'sass' => [
            'components' => ['inlineCssWrapper'],
        ],
    ],
);
