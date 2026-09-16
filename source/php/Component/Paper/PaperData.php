<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Paper;
final class PaperData { public function __construct(public string $slot = '', public bool $padding = false, public bool $transparent = false) {} }
