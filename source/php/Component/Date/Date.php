<?php

namespace ComponentLibrary\Component\Date;

/**
 * Class Date
 * Handles various date-related actions like formatting, calculating time since/until, and tooltip generation.
 */
class Date extends \ComponentLibrary\Component\BaseController
{
    private string $dateFormat = 'D d M Y';
    private ?int $currentTime = null;

    public function init()
    {
        //Setters 
        $this->setCurrentTime();
        $this->setDateFormat($this->data['format']);

        if( is_int($this->data['timestamp']) ) {
            $timestamp  = $this->data['timestamp'];
        } else {
            $timestamp  = $this->strToTime($this->data['timestamp']);
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

    /**
     * Converts a date string into a timestamp.
     * 
     * @param string $date  Date string
     * @return int|false    Timestamp if the date string was valid, false otherwise
     * 
     * @see https://www.php.net/manual/en/datetime.formats.date.php
     */
    private function strToTime($date)
    {
        // Try to parse the date string, in a simple way
        $parsedDateTime = strtotime($date);

        if ($parsedDateTime === false) {
            error_log('Date Component: Failed to parse date string from "'.$date.'" in a simple way.', E_USER_WARNING);
            return false;
        }

        return $parsedDateTime;
    }
}