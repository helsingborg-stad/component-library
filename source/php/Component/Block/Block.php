<?php

namespace ComponentLibrary\Component\Block;

/**
 * Class Block
 * @package ComponentLibrary\Component\Block
 */
class Block extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        if ($image && !isset($image['backgroundColor'])) {
            $this->data['image']['backgroundColor'] = 'primary';
        }

        if ($hasPlaceholder) {
            $this->data['classList'][] = $this->getBaseClass() . '--svg-background';
        }

        if ($link) {
            $this->data['componentElement'] = "a";
        } else {
            $this->data['componentElement'] = "div";
        }

        if (!in_array($ratio, ['1:1', '4:3', '12:16', '16:9'])) {
            $ratio = '4:3';
        }

        if ($content) {
            $this->data['content'] = strip_tags($content);
        }

        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);
    }

    /**
     * Create a excerpt from a string
     *
     * @param string $string
     * @param int $length
     * @param string $end
     * @return string
     */
    private function strWordCut($string, $length, $end = '...')
    {
        $string = strip_tags($string);

        if (strlen($string) > $length) {
            $stringCut = substr($string, 0, $length);
            $string = substr(
                $stringCut,
                0,
                strrpos($stringCut, ' ')
            ) . $end;
        }

        return $string;
    }
}
