<?php

declare(strict_types=1);

use ComponentLibrary\Component\Accordion\AccordionData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'accordion',
    view: 'accordion.blade.php',
    data: AccordionData::class,
    dependencies: [
        'sass' => [
            'components' => [
                'accordion',
                'accordion__item',
            ],
        ],
    ],
);
