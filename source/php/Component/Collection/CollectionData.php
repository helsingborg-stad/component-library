<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Collection;
final class CollectionData { public function __construct(public string $componentElement = 'div', public array|bool $list = false, public bool $bordered = false, public bool $compact = false, public bool $sharp = false, public bool $sharpBottom = false, public bool $sharpTop = false, public bool $unbox = false) {} }
