<?php

declare(strict_types=1);

use ComponentLibrary\Component\Acceptance\AcceptanceData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'acceptance',
    view: 'acceptance.blade.php',
    data: AcceptanceData::class,
    dependencies: ['sass' => ['components' => ['acceptance', 'button', 'icon', 'typography', 'iframe', 'modal']]],
);
