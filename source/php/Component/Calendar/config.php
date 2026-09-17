<?php

declare(strict_types=1);

use ComponentLibrary\Component\Calendar\CalendarData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'calendar',
    view: 'calendar.blade.php',
    data: CalendarData::class,
    dependencies: ['sass' => ['components' => ['calendar', 'modal', 'button']]],
);
