<?php

namespace ComponentLibrary\Component\Date;

/**
 * Class Dropdown
 * @package ComponentLibrary\Component\Date
 */
class Date extends \ComponentLibrary\Component\BaseController
{

    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if ($action == "formatDate") {
            $this->data['refinedDate'] = $this->formatDate(strtotime($timestamp), $format);
        } else if ($action == "timesince") {
            $this->data['refinedDate'] = $this->convertToHumanReadableUnit(strtotime($timestamp), true, $labels, $labelsPlural);
        } else if ($action == "timeuntil") {
            $this->data['refinedDate'] = $this->convertToHumanReadableUnit(strtotime($timestamp), false, $labels, $labelsPlural);
        } else {
            $this->data['refinedDate'] = $timestamp;
        }

        //Display tipbox with exact time, if relative shown.
        if (in_array($action, ['timesince', 'timeuntil'])) {
            $this->data['tooltipDate'] = $this->formatDate(strtotime($timestamp), $format);
        } else {
            $this->data['tooltipDate'] = false;
        }

        //Add excact date as metadata
        $this->data['metaDate'] = $this->formatDate(
            strtotime($timestamp),
            \ComponentLibrary\Helper\Date::getDateFormat('date-time')
        );
    }

    private function formatDate($timestamp, $format)
    {
        $format = $format ? $format : 'D d M Y';

        if (function_exists('date_i18n')) {
            $date = date_i18n($format, $timestamp);
        } else {
            $date = date($format, $timestamp);
        }

        return $date;
    }

    /**
     * Get time since a specified date
     * @param Date A timestamp of which date to count since
     * @return String Time since in words
     */
    private function convertToHumanReadableUnit($time, $timeSince = false, $labels = [], $labelsPlural = [])
    {
        $time = $timeSince ? time() - $time : $time - time();
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second',
        );

        foreach ($tokens as $unit => $text) {
            $numberOfUnits = (int) floor($time / $unit);

            if ($numberOfUnits > 1) {
                if (array_key_exists($text, $labelsPlural)) {
                    $text = $labelsPlural[$text];
                }
            } else {
                if (array_key_exists($text, $labels)) {
                    $text = $labels[$text];
                }
            }

            if ($time >= $unit) {
                return $numberOfUnits . ' ' . $text;
            }
        }

    }
}
