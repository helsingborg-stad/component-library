<?php
declare(strict_types=1);
use ComponentLibrary\Component\Logotypegrid\LogotypegridData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'logotypegrid', view: 'logotypegrid.blade.php', data: LogotypegridData::class, dependencies: ['sass' => ['components' => ['logotypegrid', 'logotype', 'image']]]);
