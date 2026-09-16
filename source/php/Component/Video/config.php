<?php
declare(strict_types=1);
use ComponentLibrary\Component\Video\VideoData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'video', view: 'video.blade.php', data: VideoData::class, dependencies: ['sass' => ['components' => ['video', 'notice', 'button', 'icon']]]);
