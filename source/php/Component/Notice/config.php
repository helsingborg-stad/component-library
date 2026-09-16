<?php
declare(strict_types=1);
use ComponentLibrary\Component\Notice\NoticeData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'notice', view: 'notice.blade.php', data: NoticeData::class, dependencies: ['sass' => ['components' => ['notice', 'icon', 'typography', 'button']]]);
