<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Popover;
final class PopoverData { public function __construct(public ?string $id = null, public string $type = 'auto', public ?string $horizontalPlacement = null, public ?string $verticalPlacement = null, public bool $relative = false, public bool $backdrop = false) {} }
