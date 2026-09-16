<?php
declare(strict_types=1);
use ComponentLibrary\Component\Hero\HeroData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'hero', view: 'hero.blade.php', data: HeroData::class, dependencies: ['sass' => ['components' => ['hero','typography','group','image']]]);
