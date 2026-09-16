<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Block;
use ComponentLibrary\Integrations\Image\ImageInterface;
final class BlockData { public function __construct(public string $heading = '', public string|array $content = '', public string|array $meta = '', public string|array $secondaryMeta = '', public array|ImageInterface|bool $image = false, public string $link = '', public string $ratio = '4:3', public string|array $date = '', public bool $dateBadge = false, public array|bool $icon = false, public ?string $iconBackgroundColor = null) {} }
