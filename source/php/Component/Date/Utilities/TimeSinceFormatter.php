<?php

namespace ComponentLibrary\Component\Date\Utilities;

class TimeSinceFormatter
{
    public function calculate(
        int $timestamp,
        int $currentTime,
        int $timeNowCap,
        string $nowLabel,
        array $labels = [],
        array $labelsPlural = []
    ): string {
        $timeDiff = max($currentTime - $timestamp, 1); // Avoid zero or negative time

        if ($timeDiff < $timeNowCap) {
            return $nowLabel;
        }

        return $this->convertToHumanReadableUnit($timeDiff, $labels, $labelsPlural);
    }

    private function convertToHumanReadableUnit(int $timeDiff, array $labels, array $labelsPlural): string
    {
        $units = [
            31536000 => 'year', 2592000 => 'month', 604800 => 'week',
            86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second'
        ];

        foreach ($units as $unit => $label) {
            $numUnits = floor($timeDiff / $unit);
            if ($numUnits >= 1) {
                $label = $numUnits > 1 && isset($labelsPlural[$label])
                    ? $labelsPlural[$label]
                    : ($labels[$label] ?? $label);
                return $numUnits . ' ' . $label;
            }
        }

        return 'just now';
    }
}