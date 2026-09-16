<?php

declare(strict_types=1);

use ComponentLibrary\Component\Testimonials\TestimonialsData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;

return new ComponentConfig(
    slug: 'testimonials',
    view: 'testimonials.blade.php',
    data: TestimonialsData::class,
    dependencies: ['sass' => ['components' => ['testimonials', 'image', 'typography', 'card']]],
);
