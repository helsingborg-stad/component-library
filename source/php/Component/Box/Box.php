<?php

namespace ComponentLibrary\Component\Box;

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

        if ($link) {
            $this->data['componentElement'] = "a";
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

        //Reset - Decides how to switch between data inputs
		$this->renderMostImportant();

        $this->data['classList'][] = $this->getBaseClass() . '--ratio-' . str_replace(":", "-", $ratio);
    }

    /**
	 * renderMostImportant
	 */
	public function renderMostImportant()
	{
		//Reset icon if image set
		if ($this->data['image']['src'] ?? false) {
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
