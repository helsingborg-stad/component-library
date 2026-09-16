<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Timeline;
final class TimelineData { public function __construct(public array $events = [], public bool $sequential = false) {} }
