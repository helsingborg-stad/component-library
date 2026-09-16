<?php

declare(strict_types=1);

use ComponentLibrary\Component\ProgressBar\ProgressBarData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'progressBar',
    view: 'progressBar.blade.php',
    data: ProgressBarData::class,
);
