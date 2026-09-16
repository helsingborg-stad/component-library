<?php
declare(strict_types=1);
use ComponentLibrary\Component\Collection\CollectionData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'collection', view: 'collection.blade.php', data: CollectionData::class, dependencies: ['sass' => ['components' => ['collection', 'collection__item', 'typography', 'link', 'icon']]]);
