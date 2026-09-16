<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Textarea;
final class TextareaData { public function __construct(public string $label = '', public bool $required = false, public string $value = '') {} }
