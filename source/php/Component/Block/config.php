<?php
declare(strict_types=1);
use ComponentLibrary\Component\Block\BlockData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'block', view: 'block.blade.php', data: BlockData::class, dependencies: ['sass' => ['components' => ['block','image','typography','group']]]);
