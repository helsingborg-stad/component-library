<?php

declare(strict_types=1);

use ComponentLibrary\Component\Person\PersonData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'person',
    view: 'person.blade.php',
    data: PersonData::class,
    dependencies: ['sass' => ['components' => ['card', 'typography', 'icon', 'signature']]],
);
