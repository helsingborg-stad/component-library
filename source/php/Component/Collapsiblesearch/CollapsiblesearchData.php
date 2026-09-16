<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Collapsiblesearch;
final class CollapsiblesearchData { public function __construct(public array $button = [], public string $placeholder = 'Search…', public string $inputName = 's', public string $inputLabel = 'Search', public string $action = '', public string $method = 'get', public string $closeLabel = 'Close search', public bool $isExpanded = false, public array $lang = []) {} }
