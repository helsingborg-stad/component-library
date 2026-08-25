<?php

namespace ComponentLibrary\Component\Brand;

use ComponentLibrary\Traits\ResolvesAspectRatio;

class Brand extends \ComponentLibrary\Component\BaseController
{
    use ResolvesAspectRatio;

    private const DEFAULT_VIEWBOX_WIDTH = 500;
    private const DEFAULT_VIEWBOX_HEIGHT = 96;

    public function init() {

        //Extract array for eazy access (fetch only)
        extract($this->data);

        //Add class for logo
        if(!empty($logotype) && is_array($logotype)) {
            $this->data['logotype']['classList'][] = $this->getBaseClass("logotype"); 
        }

        //Normalize text
        if(!is_array($text) || empty($text)) {
            $this->data['text'] = false;
        }

        if(empty($text)) {
            $this->data['logotype']['attributeList'] = $attributeList; 
        }

        // Apply aspect-ratio style when a valid aspectRatio is provided
        $this->applyAspectRatioStyle(
            $this->parseAspectRatioFormats((string) $aspectRatio) ?? ''
        );

        // If aspectRatio is not provided, add default view box, else, calculate view box based on aspect ratio
        $viewBoxWidth = empty($aspectRatio) ? self::DEFAULT_VIEWBOX_WIDTH: $this->getViewBoxWidth((string) $aspectRatio);

        // Set the viewBox attribute for the SVG element
        $this->data['viewBox'] = '0 0 ' . $viewBoxWidth . ' ' . self::DEFAULT_VIEWBOX_HEIGHT;
    }

    /* Parser for aspect ratio formats like "16:9", "4/3", "16x9", or float formats like "1.77" 
     *
     * @param string $aspectRatio The aspect ratio in string format (e.g., "16:9", "4/3", "1.77").
     * @return array|null Returns an array with width and height if the format is valid, otherwise null.
     */
    private function parseAspectRatioFormats(string $aspectRatio): ?array
    {
        // Match formats like "16:9" or "4:3"
        if (preg_match('/^(\d+):(\d+)$/', $aspectRatio, $matches)) {
            return [$matches[1], $matches[2]];
        }

        // Match formats like "16/9" or "4/3"
        if (preg_match('/^(\d+)\/(\d+)$/', $aspectRatio, $matches)) {
            return [$matches[1], $matches[2]];
        }

        //Match formats like "16x9" or "4x3"
        if (preg_match('/^(\d+)x(\d+)$/', $aspectRatio, $matches)) {
            return [$matches[1], $matches[2]];
        }

        //Match float formats like "1.77" or "1.33"
        if (preg_match('/^(\d+(\.\d+)?)$/', $aspectRatio, $matches)) {
            return [floatval($matches[1]), 1];
        }

        return null;
    }

    /* Calculate the viewBox width based on the provided aspect ratio 
     *
     * @param string $aspectRatio The aspect ratio in string format (e.g., "16:9", "4/3", "1.77").
     * @return int The calculated viewBox width based on the aspect ratio.
     */
    private function getViewBoxWidth(string $aspectRatio): int
    {
        $parsed = $this->parseAspectRatioFormats($aspectRatio);

        if ($parsed === null) {
            return self::DEFAULT_VIEWBOX_WIDTH;
        }

        [$width, $height] = $parsed;

        if ((float) $height <= 0 || (float) $width <= 0) {
            return self::DEFAULT_VIEWBOX_WIDTH;
        }

        return (int) round((self::DEFAULT_VIEWBOX_HEIGHT / (float) $height) * (float) $width);
    }
}
