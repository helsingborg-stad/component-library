<?php

namespace ComponentLibrary\Component\Datebadge;

class Datebadge extends \ComponentLibrary\Component\BaseController implements DatebadgeInterface
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        $this->data['classList'][] = $this->getBaseClass($size, true);
        $this->data['classList'][] = $this->getBaseClass($color, true);

        if (!empty($translucent)) {
            $this->data['classList'][] = $this->getBaseClass('translucent', true);
        }

        //Format
        $date = !is_int($date) ? strtotime($date) : $date;
        $this->data['month']    = $this->getDateFunc("M", $date);
        $this->data['day']      = $this->getDateFunc("j", $date);
    }

    /**
     * Switch between date functions
     *
     * @param [type] $format
     * @param [type] $date
     * @return void
     */
    private function getDateFunc($format, $date)
    {
        if (function_exists('wp_date')) {
            return wp_date($format, $date);
        }
        return date($format, $date);
    }
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'datebadge';
    }

    // -------------------------------------------------------------------------
    // DatebadgeInterface — generated getters
    // -------------------------------------------------------------------------

    public function getDate(): string|int
    {
        return $this->data['date'] ?? false;
    }

    public function getSize(): string
    {
        return $this->data['size'] ?? 'md';
    }

    public function getTranslucent(): bool
    {
        return $this->data['translucent'] ?? false;
    }

    public function getColor(): string
    {
        return $this->data['color'] ?? 'light';
    }
}
