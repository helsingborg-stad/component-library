<?php
declare(strict_types=1);
use ComponentLibrary\Component\Fileinput\FileinputData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'fileinput', view: 'fileinput.blade.php', data: FileinputData::class, dependencies: ['sass' => ['components' => ['fileInput', 'icon', 'button']]]);
