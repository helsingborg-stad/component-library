<?php

namespace ComponentLibrary\Component\Date;

/**
 * Class Date
 * @package ComponentLibrary\Component\Date
 */
class Date extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Extract data for easy access
        extract($this->data);

        $timestamp = strtotime($timestamp);
        $this->data['timeSinceSuffix'] = "";

        switch ($action) {
            case "formatDate":
                $this->data['refinedDate'] = $this->formatDate($timestamp, $format);
                break;

            case "timesince":
                $timeDiff = time() - $timestamp;
                if ($timeDiff < $timeNowCap) {
                    $this->data['refinedDate'] = $this->data['nowLabel'];
                } else {
                    $this->data['refinedDate'] = $this->convertToHumanReadableUnit($timestamp, true, $labels, $labelsPlural);
                    $this->data['timeSinceSuffix'] = $timeSinceSuffix;
                }
                break;

            case "timeuntil":
                $this->data['refinedDate'] = $this->convertToHumanReadableUnit($timestamp, false, $labels, $labelsPlural);
                break;

            default:
                $this->data['refinedDate'] = $timestamp;
                break;
        }

        // Tooltip for relative time (timesince/timeuntil)
        $this->data['tooltipDate'] = in_array($action, ['timesince', 'timeuntil'])
            ? $this->formatDate($timestamp, $format)
            : false;

        // Add exact date as metadata
        $this->data['metaDate'] = $this->formatDate($timestamp, \ComponentLibrary\Helper\Date::getDateFormat('date-time'));
    }

    private function formatDate($timestamp, $format)
    {
        return function_exists('date_i18n') ? date_i18n($format ?? 'D d M Y', $timestamp) : date($format ?? 'D d M Y', $timestamp);
    }

    private function convertToHumanReadableUnit($time, $timeSince = false, $labels = [], $labelsPlural = [])
    {
        $timeDiff = $timeSince ? time() - $time : $time - time();
        $timeDiff = max($timeDiff, 1);

        $units = [
            31536000 => 'year', 2592000 => 'month', 604800 => 'week',
            86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second'
        ];

        foreach ($units as $unit => $label) {
            $numUnits = floor($timeDiff / $unit);
            if ($numUnits >= 1) {
                $label = ($numUnits > 1 && isset($labelsPlural[$label])) ? $labelsPlural[$label] : ($labels[$label] ?? $label);
                return $numUnits . ' ' . $label;
            }
        }
    }
}