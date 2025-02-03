<?php

namespace ComponentLibrary\Component\Date;

use ComponentLibrary\Component\Date\Utilities\DateFormatter;
use ComponentLibrary\Component\Date\Utilities\TimeSinceFormatter;
use ComponentLibrary\Component\Date\Config\DateConfig;

/**
 * Class Date
 * Handles various date-related actions like formatting, calculating time since/until, and tooltip generation.
 */
class Date extends \ComponentLibrary\Component\BaseController
{
    private string $dateFormat = 'D d M Y';
    private ?DateFormatter $dateFormatter = null;
    private ?TimeSinceFormatter $timeSinceFormatter = null;
    private ?DateConfig $config = null;

    public function init(): void
    {
        // Initialize helpers & config
        $this->dateFormatter        = new DateFormatter();
        $this->timeSinceFormatter   = new TimeSinceFormatter();
        $this->config               = new DateConfig();

        // Set initial values if provided
        $this->config->setDateFormat($this->data['dateFormat'] ?? null);

        // Parse timestamp
        $timestamp = $this->inputDateToTimestamp($this->data['timestamp']);

        // Handle date output
        if ($timestamp instanceof \Exception) {
            $this->setInvalidDate();
        } else {
            $this->setValidDate($timestamp);
        }

        //Set default values for missing keys
        $this->data = $this->sanitizeReturn();
    }

    /**
     * Handles the case where the date is invalid.
     * 
     * @return void
     */
    private function setInvalidDate(): void
    {
        $this->data = array_merge($this->data, [
            'refinedDate'      => '-',
            'dateError'        => "Invalid date",
            'timeSinceSuffix'  => '',
            'tooltipDate'      => false,
        ]);
    }

    /**
     * Handles the case where the date is valid.
     * 
     * @param int $timestamp
     * 
     * @return void
     */
    private function setValidDate(int $timestamp): void
    {
        $isTimeSince = $this->data['action'] === "timesince";

        $this->data['refinedDate']      = $isTimeSince ? $this->handleTimeSince($timestamp) : $this->handleFormatDate($timestamp);
        $this->data['timeSinceSuffix']  = (function () use ($isTimeSince) {
            return ($isTimeSince && $this->data['refinedDate'] !== ($this->data['nowLabel'] ?? '')) 
                ? ($this->data['timeSinceSuffix'] ?? '') 
                : '';
        })();

        $this->data['tooltipDate']      = $this->getToolTipLabel($timestamp, $this->dateFormat, $this->data['action']);
        $this->data['attributeList']['data-date'] = $this->getMetaDateFromTimestamp($timestamp);
        
        if ($isTimeSince) {
            $this->data['attributeList']['data-tooltip'] = $this->handleFormatDate($timestamp);
        }
    }

    /**
     * Sanitize the return array.
     * 
     * @return array
     */
    public function sanitizeReturn(): array
    {
        return array_merge([
            'refinedDate'   => '',
            'tooltipDate'   => '',
            'metaDate'      => '',
            'dateError'     => false,
        ], $this->data);
    }

    /**
     * Convert the input date to a Unix timestamp.
     * 
     * @param string|int $timestamp
     * 
     * @return int
     */
    private function inputDateToTimestamp(string|int $timestamp): int|\Exception
    {
        return is_int($timestamp)
            ? $timestamp
            : $this->strToTime($timestamp);
    }

    /**
     * Handle the date formatting.
     * 
     * @param int $timestamp
     */
    private function handleFormatDate(int $timestamp): string
    {
        return $this->dateFormatter->format($timestamp, $this->dateFormat);
    }

    /**
     * Handle the time since calculation.
     * 
     * @param int $timestamp
     * 
     * @return string
     */
    private function handleTimeSince(int $timestamp)
    {
        return $this->timeSinceFormatter->calculate(
            $timestamp,
            time(),
            $this->data['timeNowCap'] ?? $this->config->getTimeNowCap(),
            $this->data['nowLabel'] ?? $this->config->getNowLabel(),
            $this->data['labels'] ?? [],
            $this->data['labelsPlural'] ?? []
        );
    }

    /**
     * Get the tooltip label for a date.
     * 
     * @param int $timestamp
     * @param string $format
     * @param string $action
     * 
     * @return string
     */
    private function getToolTipLabel(int $timestamp, string $format, string $action)
    {
        $this->data['action'] === 'timesince'
            ? $this->dateFormatter->format($timestamp, $this->dateFormat)
            : false;
    }

    /**
     * Get the meta date from a timestamp.
     * 
     * @param int $timestamp
     * 
     * @return string
     */
    private function getMetaDateFromTimestamp(int $timestamp): string
    {
        return $this->dateFormatter->format($timestamp, 'Y-m-d\TH:i:s');
    }

    /**
     * Converts a date string to a Unix timestamp.
     * 
     * @param string $date
     * 
     * @return int|\Exception   Unix timestamp or an exception if the date string could not be parsed.
     */
    private function strToTime(string $date): int|\Exception
    {
        if (($unixTime = strtotime($date)) === false) {
            return new \Exception('Date Component: Failed to parse date string from "'.$date.'".');
        }
        return $unixTime;
    }
}