<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Divider;
final class DividerData { public function __construct(public string $componentElement = 'div', public string $style = 'dashed', public string $size = 'md', public string $title = '', public string $titleVariant = 'h2', public string $align = 'center', public bool $frame = true, public bool $customFont = false) {} }
