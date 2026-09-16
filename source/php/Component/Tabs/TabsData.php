<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Tabs;

final class TabsData
{
    public function __construct(public string $id = '', public string $componentElement = 'div', public array $tabs = [], public string $contentElement = 'div')
    {
    }
}
