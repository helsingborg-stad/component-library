<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Drawer;
final class DrawerData { public function __construct(public string $label = 'Close', public array $screenSizes = ['xs', 'sm', 'md', 'lg', 'xl'], public array $toggleButtonData = []) {} }
