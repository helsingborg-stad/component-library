<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Breadcrumb;
final class BreadcrumbData { public function __construct(public array $list = [], public string $label = 'Breadcrumb', public string $componentElement = 'nav', public string $listType = 'ol', public string $listItemType = 'li', public string $prefixLabel = '', public int|bool|null $truncate = null) {} }
