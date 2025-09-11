<?php

namespace ComponentLibrary\Component\Date\Config;

class DateConfig
{
    private string $fallbackDateFormat = 'D d M Y';
    private ?string $dateFormat = null;

    /**
     * Get the date format
     *
     * @return string
     */
    public function getDateFormat(): string
    {
      return $this->dateFormat ?? $this->fallbackDateFormat;
    }

    /**
     * Get the time now cap
     *
     * @return int
     */
    public function getTimeNowCap(): int
    {
      return 3600;
    }

    /**
     * Get the label for "just now"
     *
     * @return string
     */
    public function getNowLabel(): string
    {
      return 'just now';
    }

    /**
     * Set the date format
     *
     * @param string|null $format
     */
    public function setDateFormat(?string $format): void
    {
      if(!is_null($format)) {
        $this->dateFormat = $format;
      }
    }
}