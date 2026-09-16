<?php
declare(strict_types=1);
namespace ComponentLibrary\Component\Date;
final class DateData { public function __construct(public string|int $timestamp = '', public bool $time_since = false, public string $time_since_cap = '6 months', public ?string $format = null, public string $region = 'en_US', public string $timezone = 'UTC', public string $action = 'formatDate', public array $labels = [], public array $labelsPlural = [], public string $timeSinceSuffix = 'ago', public string $nowLabel = 'just now', public int $timeNowCap = 60) {} }
