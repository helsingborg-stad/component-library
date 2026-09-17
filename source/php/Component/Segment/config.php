<?php

declare(strict_types=1);

use ComponentLibrary\Component\Segment\SegmentData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'segment',
    view: 'segment.blade.php',
    data: SegmentData::class,
    dependencies: ['sass' => ['components' => ['segment', 'typography', 'button', 'group']]],
);
