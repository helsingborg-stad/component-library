<?php
declare(strict_types=1);
use ComponentLibrary\Component\Chat__input\ChatInputData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'chat__input', view: 'chat__input.blade.php', data: ChatInputData::class, dependencies: ['sass' => ['components' => ['chat__input', 'element']]]);
