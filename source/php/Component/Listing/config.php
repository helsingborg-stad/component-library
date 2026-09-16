<?php

declare(strict_types=1);

use ComponentLibrary\Component\Listing\ListingData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'listing',
    view: 'listing.blade.php',
    data: ListingData::class,
    dependencies: ['sass' => ['components' => ['list', 'icon']]],
);
