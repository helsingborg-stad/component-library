<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Calendar;
final class CalendarData { public function __construct(public string $componentElement = 'div', public string $size = 'large', public string $get = '', public string $set = '', public string $color = 'default', public string $weekStart = 'Monday') {} }
