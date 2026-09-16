<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Acceptance;
final class AcceptanceData { public function __construct(public array|object|bool $labels = false, public string|bool $height = false, public array|bool $src = false, public string|bool $policy = false, public string|bool $host = false, public string|bool $name = false, public string $icon = 'info', public string|bool $cover = false, public string $modifier = '', public bool $requiresAccept = true) {} }
