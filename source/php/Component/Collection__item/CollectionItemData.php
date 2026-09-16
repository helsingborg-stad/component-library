<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Collection__item;
final class CollectionItemData { public function __construct(public string $componentElement = 'div', public string $prefix = '', public array|bool $icon = false, public array|bool $iconLast = false, public array|bool $action = false, public string $secondary = '', public string $link = '', public bool $bordered = false) {} }
