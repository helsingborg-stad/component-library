<?php
declare(strict_types=1);
use ComponentLibrary\Component\Field\FieldData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'field', view: 'field.blade.php', data: FieldData::class, dependencies: ['sass' => ['components' => ['fields', 'icon']]]);
