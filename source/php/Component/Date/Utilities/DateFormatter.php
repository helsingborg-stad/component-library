<?php

namespace ComponentLibrary\Component\Date\Utilities;

class DateFormatter
{
    public function format(int $timestamp, string $format): string
    {
        return function_exists('date_i18n') 
            ? date_i18n($format, $timestamp) 
            : date($format, $timestamp);
    }
}