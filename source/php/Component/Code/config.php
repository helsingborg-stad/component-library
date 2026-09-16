<?php
declare(strict_types=1);
use ComponentLibrary\Component\Code\CodeData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'code', view: 'code.blade.php', data: CodeData::class, dependencies: ['sass' => ['components' => ['code']]]);
