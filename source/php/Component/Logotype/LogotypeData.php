<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Logotype;
final class LogotypeData { public function __construct(public string|bool $src = false, public string $alt = '', public string $caption = '', public string $title = '', public string $placeholderText = 'Image missing', public bool $maskable = false, public int|float|string|bool $aspectRatio = false) {} }
