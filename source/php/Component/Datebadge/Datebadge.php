<?php

namespace ComponentLibrary\Component\Datebadge;

class Datebadge extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Sizes
        if (in_array($size, ['sm', 'md'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--" . $size;
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--md";
        }

        //Format
        $date = !is_int($date) ? strtotime($date) : $date;
        $this->data['month']    = $this->getDateFunc("M", $date);
        $this->data['day']      = $this->getDateFunc("j", $date);
        $this->data['time']     = $this->getDateFunc("H:i", $date);
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
}
