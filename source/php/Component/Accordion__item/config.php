<?php
declare(strict_types=1);
use ComponentLibrary\Component\Accordion__item\AccordionItemData;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
return new ComponentConfig(slug: 'accordion__item', view: 'accordion__item.blade.php', data: AccordionItemData::class, dependencies: ['sass' => ['components' => ['accordion__item', 'icon']]]);
