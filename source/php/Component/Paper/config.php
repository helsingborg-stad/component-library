<?php
declare(strict_types=1);
use ComponentLibrary\Component\Paper\PaperData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'paper', view: 'paper.blade.php', data: PaperData::class, dependencies: ['sass' => ['components' => ['paper']]]);
