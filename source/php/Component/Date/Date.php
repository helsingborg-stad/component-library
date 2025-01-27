<?php

namespace ComponentLibrary\Component\Date;

use IntlDateFormatter;

/**
 * Class Date
 * Handles various date-related actions like formatting, calculating time since/until, and tooltip generation.
 */
class Date extends \ComponentLibrary\Component\BaseController
{
    private string $dateFormat = 'D d M Y';
    private ?string $dateRegion = null; 
    private ?string $dateTimeZone = null;
    private ?int $currentTime = null;

    public function init()
    {
        //Setters 
        $this->setCurrentTime();
        $this->setDateFormat($this->data['format']);
        $this->setDateRegion($this->data['region']);
        $this->setDateTimezone($this->data['timezone']); 

        if( $this->isValidtimestamp($this->data['timestamp']) ) {
            $timestamp  = $this->data['timestamp'];
        } else {
            throw new \InvalidArgumentException('Invalid timestamp');
        }

        //Handle the action
        switch ($this->data['action']) {
            case "timesince":
                $this->handleTimeSince($timestamp);
                break;

            default:
                // Also handler case for "formatDate" action.
                $this->handleFormatDate($timestamp, $this->dateFormat);
                break;
        }

        //Set tooltip date
        $this->setTooltipDate(
            $this->data['action'], 
            $timestamp, 
            $this->dateFormat
        );

        //Set meta date
        $this->setMetaDate($timestamp);
    }

    private function isValidtimestamp(mixed $timestamp):bool 
    {
        return is_int($timestamp);
    }

    /**
     * Sets the current time for the component.
     */
    private function setCurrentTime()
    {
        $this->currentTime = time();
    }

    /**
     * Sets the date format for formatting.
     * 
     * @param string $format  Date format
     * @return bool           True if the format was set, false otherwise
     */
    private function setDateFormat($format)
    {
        if($format) {
            $this->dateFormat = $format;
            return true;
        }
        return false;
    }

    /**
     * Sets the date region for formatting.
     * 
     * @param string $region  Region code
     * @return bool           True if the region was set, false otherwise
     */
    private function setDateRegion($region)
    {
        if($region) {
            $this->dateRegion = $region;
            return true;
        }
        return false;
    }

    /**
     * Sets the timezone for formatting.
     * 
     * @param string $timezone  Timezone
     * @return bool             True if the timezone was set, false otherwise
     */
    private function setDateTimezone($timezone)
    {
        if($timezone) {
            $this->dateTimeZone = $timezone;
            return true;
        }
        return false;
    }

    /**
     * Handles the formatDate action.
     */
    private function handleFormatDate($timestamp, $format)
    {
        $this->data['refinedDate'] = $this->formatDate($timestamp, $format);
    }

    /**
     * Handles the timesince action.
     */
    private function handleTimeSince($timestamp)
    {
        $timeDiff   = $this->currentTime - $timestamp;
        $timeNowCap = $this->data['timeNowCap'] ?? 3600;  // Default cap to 1 hour
        $nowLabel   = $this->data['nowLabel'] ?? 'Just now';

        if ($timeDiff < $timeNowCap) {
            $this->data['refinedDate'] = $nowLabel;
        } else {
            $this->data['refinedDate'] = $this->convertToHumanReadableUnit(
                $timestamp, true, $this->data['labels'] ?? [], $this->data['labelsPlural'] ?? []
            );
            $this->data['timeSinceSuffix'] = $this->data['timeSinceSuffix'] ?? '';
        }
    }

    /**
     * Sets the tooltip date if applicable.
     */
    private function setTooltipDate($action, $timestamp, $format)
    {
        if ($action === 'timesince') {
            $this->data['tooltipDate'] = $this->formatDate($timestamp, $format);
        } else {
            $this->data['tooltipDate'] = false;
        }
    }

    /**
     * Sets the metaDate field for exact date metadata.
     */
    private function setMetaDate($timestamp)
    {
        //Create ISO 8601 date for meta
        $this->data['metaDate'] = $this->formatDate(
            $timestamp, 
            'Y-m-d\TH:i:s'
        );
    }

    /**
     * Formats the given timestamp into the specified format.
     */
    private function formatDate($timestamp, $format)
    {
        $this->data['timeSinceSuffix'] = false;
        return function_exists('date_i18n')
            ? date_i18n($format, $timestamp)
            : date($format, $timestamp);
    }

    /**
     * Converts a timestamp into a human-readable time unit (like "2 hours ago").
     */
    private function convertToHumanReadableUnit($timestamp, $timeSince = false, $labels = [], $labelsPlural = [])
    {
        $timeDiff = $timeSince ? $this->currentTime - $timestamp : $timestamp - $this->currentTime;
        $timeDiff = max($timeDiff, 1);  // Avoid negative or zero

        $units = [
            31536000 => 'year', 2592000 => 'month', 604800 => 'week',
            86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second'
        ];

        foreach ($units as $unit => $label) {
            $numUnits = floor($timeDiff / $unit);
            if ($numUnits >= 1) {
                $label = $numUnits > 1 && isset($labelsPlural[$label]) ? $labelsPlural[$label] : ($labels[$label] ?? $label);
                return $numUnits . ' ' . $label;
            }
        }

        return 'just now';  // Default fallback
    }
}