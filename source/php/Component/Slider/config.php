<?php
declare(strict_types=1);
use ComponentLibrary\Component\Slider\SliderData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'slider', view: 'slider.blade.php', data: SliderData::class, dependencies: ['sass' => ['components' => ['slider','button','icon']]]);
