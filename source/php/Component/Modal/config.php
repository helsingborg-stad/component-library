<?php

declare(strict_types=1);

use ComponentLibrary\Component\Modal\ModalData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'modal',
    view: 'modal.blade.php',
    data: ModalData::class,
    dependencies: ['sass' => ['components' => ['modal', 'icon', 'typography', 'button']]],
);
