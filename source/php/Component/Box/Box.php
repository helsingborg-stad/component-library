<?php

namespace ComponentLibrary\Component\Box;

use ComponentLibrary\Integrations\Image\ImageInterface;

/**
 * Class Box
 * @package ComponentLibrary\Component\Box
 */
class Box extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Extract array for easy access (fetch only)
        extract($this->data);

        $this->data['metaAreaSlotHasData'] = $this->slotHasData('metaArea');
        $this->data['slotHasData']         = $this->slotHasData('slot');


        if ($link) {
            $this->data['componentElement'] = "a";
            $this->data['attributeList']['href'] = $link;
        } else {
            $this->data['componentElement'] = "div";
        }

        if (!in_array($ratio, ['1:1', '4:3', '12:16'])) {
            $ratio = '1:1';
        }

        if ($content) {
            $this->data['content'] = $this->strWordCut(
                strip_tags($content),
                200
            );
        }

        if ($date && !is_array($date)) {
            $this->data['date'] = [
                'timestamp' => $date,
                'action' => 'formatDate'
            ];
        }

        //Make componet take string as ico param (backward compatibility)
        if (is_string($icon) && !empty($icon)) {
            $this->data['icon'] = ['name' => $icon];
        }

        //Reset - Decides how to switch between data inputs
        $this->renderMostImportant();

        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);
    }

    private function hasImage():bool
    {
        return match (true) {
            $this->data['image'] instanceof ImageInterface => true,
            is_array($this->data['image']) && empty($this->data['image']['src']) => true,
            default => false,
        };
    }

    /**
     * renderMostImportant
     */
    public function renderMostImportant()
    {
        //Reset icon if image set
        if($this->hasImage()) {
            $this->data['icon'] = null;
        } else {
            $this->data['image'] = null;
        }

        //Reset image if icon set
        if ($this->data['icon']['name'] ?? false) {
            $this->data['image'] = null;
        } else {
            $this->data['icon'] = null;
        }
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
