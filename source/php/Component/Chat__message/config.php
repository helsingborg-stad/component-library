<?php
declare(strict_types=1);
use ComponentLibrary\Component\Chat__message\ChatMessageData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'chat__message', view: 'chat__message.blade.php', data: ChatMessageData::class, dependencies: ['sass' => ['components' => ['chat__message', 'element']]]);
