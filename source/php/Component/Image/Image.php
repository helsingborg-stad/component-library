<?php

namespace ComponentLibrary\Component\Image;

use ComponentLibrary\Integrations\Image\ImageInterface;

class Image extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        if ($this->data['imgAttributeList'] instanceof \stdClass) {
            $this->data['imgAttributeList'] = get_object_vars($this->data['imgAttributeList']);
        }

        // Handle image processing
        if ($this->data['src'] instanceof ImageInterface) {
            $this->handleImageProcessing(
                $this->data['src'],
                $this->data['alt'],
                $this->data['lqipEnabled']
            );
        } else {
            $this->data['containerQueryData'] = null;
        }

        // Handle filetype class
        $this->handleFileTypeClass($this->data['src']);

        // Handle additional classes
        $this->addAdditionalClasses(
            $this->data['fullWidth'],
            $this->data['cover'],
            $this->data['src']
        );

        // Handle alt text
        $this->setAltText($this->data['alt'], $this->data['caption']);

        // Set byline if available
        $this->setByline($this->data['byline']);

        // Add rounded corners class
        $this->addRoundedClass($this->data['rounded']);

        // Handle placeholder class
        $this->addPlaceholderClass($this->data['src']);

        // Add image defaults and responsive attributes
        $this->addDefaultImageAttributes();
        $this->addSrcsetToAttributes($this->data['srcset']);

        // Build img attributes
        $this->data['imgAttributes'] = self::buildAttributes($this->data['imgAttributeList']);

        // Build wrapper attributes
        if (!isset($this->data['wrapperAttributes'])) {
            $this->data['wrapperAttributes'] = [];
        }
        $this->data['wrapperAttributes'] = self::buildAttributes($this->data['wrapperAttributes']);

        // Add class if alt-text is missing
        if (empty($this->data['alt']) && (!empty($placeholderEnabled) && !empty($placeholderIcon))) {
            $this->data['attributeList']['data-a11y-error'] = "Alt text is missing";
        }
    }

    private function addPlaceholderClass($src)
    {
        if (!$src) {
            $this->data['classList'][] = $this->getBaseClass() . "--is-placeholder";
        }
    }

    private function handleImageProcessing(ImageInterface $src, &$alt, $lqipEnabled)
    {
        $imageUrl = $src->getUrl();

        //If source is SVG, then there is no need to do any container query processing
        if ($this->getExtension($imageUrl) === 'svg') {
            $this->data['src'] = $imageUrl;
            $this->data['classList'][] = $this->getBaseClass('svg-background', true);
            $this->data['containerQueryData'] = null;
            return;
        }

        $containerQueryData = $src->getContainerQueryData();
        $this->data['containerQueryData'] = null;
        $this->data['src'] = $imageUrl;
        $this->data['srcset'] = $src->getSrcSet();
        $focusPoint = $src->getFocusPoint();
        $this->data['focus'] = sprintf("object-position: %s;", $this->reduceFocusPoint($focusPoint));
        $this->addResponsiveImageAttributes($containerQueryData, $this->data['srcset'], $this->data['focus']);

        if (empty($alt)) {
            $alt = $this->data['alt'] = $src->getAltText();
        }

        //Add aspect ratio, if not in cover mode or calculateAspectRatio is false.
        if(!$this->data['cover'] && $this->data['calculateAspectRatio']) {
            $this->addWrapperAspectRatio($containerQueryData);
        }

        $lqipUrl = $lqipEnabled ? $src->getLqipUrl() : null;
        if ($lqipUrl) {
            $this->addLowResolutionPlaceholder($lqipUrl, $focusPoint);
        }
    }

    private function resolveAspectRatioFromContainerQueryData($containerQueryData): ?string
    {
        if (is_array($containerQueryData) && !empty($containerQueryData)) {
            foreach ($containerQueryData as $data) {
                if (isset($data['aspectRatio']) && !is_null($data['aspectRatio'])) {
                    return $data['aspectRatio'];
                }
            }
        }
        return null;
    }

    private function addWrapperAspectRatio(array $containerQueryData)
    {
        if (!isset($this->data['wrapperAttributes']['style'])) {
            $this->data['wrapperAttributes']['style'] = "";
        }

        $aspectRatio = $this->resolveAspectRatioFromContainerQueryData($containerQueryData) ?? '16/9';

        $this->data['wrapperAttributes']['style'] .= "aspect-ratio:{$aspectRatio};";
    }

    private function addLowResolutionPlaceholder(string $lqipUrl, array $focusPoint)
    {
        if (!isset($this->data['wrapperAttributes']['style'])) {
            $this->data['wrapperAttributes']['style'] = "";
        }
        $this->data['wrapperAttributes']['style'] .= sprintf(
            "background-image: url(%s); background-position: %s;",
            $lqipUrl,
            $this->reduceFocusPoint($focusPoint)
        );
    }

    private function addSrcsetToAttributes($srcset)
    {
        if ($srcset) {
            $this->data['imgAttributeList']['srcset'] = $srcset;
        }
    }

    /**
     * Keep content images lazy by default while allowing callers such as Hero
     * to opt into eager, high-priority loading through imgAttributeList.
     */
    private function addDefaultImageAttributes(): void
    {
        if (!isset($this->data['imgAttributeList']['loading'])) {
            $this->data['imgAttributeList']['loading'] = 'lazy';
        }
    }

    /**
     * Describe one responsive image instead of rendering one hidden image per
     * candidate. Container units retain component-level sizing, while an
     * unsupported sizes value falls back to the HTML default of 100vw.
     */
    private function addResponsiveImageAttributes(array $containerQueryData, $srcset, string $focus): void
    {
        if ($srcset && !isset($this->data['imgAttributeList']['sizes'])) {
            $this->data['imgAttributeList']['sizes'] = '100cqw';
        }

        $existingStyle = trim((string) ($this->data['imgAttributeList']['style'] ?? ''));
        if ($existingStyle !== '' && substr($existingStyle, -1) !== ';') {
            $existingStyle .= ';';
        }
        $this->data['imgAttributeList']['style'] = trim($existingStyle . ' ' . $focus);

        $dimensions = $this->resolveDimensionsFromContainerQueryData($containerQueryData);
        if ($dimensions === null) {
            return;
        }

        if (!isset($this->data['imgAttributeList']['width'])) {
            $this->data['imgAttributeList']['width'] = $dimensions[0];
        }
        if (!isset($this->data['imgAttributeList']['height'])) {
            $this->data['imgAttributeList']['height'] = $dimensions[1];
        }
    }

    /**
     * Use the largest generated candidate as the intrinsic image dimensions.
     * The browser preserves this ratio even when CSS scales or crops the image.
     */
    private function resolveDimensionsFromContainerQueryData(array $containerQueryData): ?array
    {
        for ($index = count($containerQueryData) - 1; $index >= 0; $index--) {
            $aspectRatio = $containerQueryData[$index]['aspectRatio'] ?? null;
            if (!is_string($aspectRatio)) {
                continue;
            }

            $dimensions = array_map('intval', explode('/', $aspectRatio, 2));
            if (count($dimensions) === 2 && $dimensions[0] > 0 && $dimensions[1] > 0) {
                return $dimensions;
            }
        }

        return null;
    }

    private function handleFileTypeClass($src)
    {
        if (is_string($src) && $extension = $this->getExtension($src)) {
            $this->data['classList'][] = $this->getBaseClass("type-" . $extension, true);
        }
    }

    private function addAdditionalClasses($fullWidth, $cover, $src)
    {
        if ($fullWidth) {
            $this->data['classList'][] = $this->getBaseClass('full-width', true);
        }

        if ($cover) {
            $this->data['classList'][] = $this->getBaseClass('cover', true);
        }

        if (!$src) {
            $this->data['classList'][] = $this->getBaseClass('is-placeholder', true);
        }
    }

    private function setAltText(&$alt, $caption)
    {
        if (!$alt) {
            $this->data['alt'] = !empty($caption) ? $caption : "";
        }
    }

    private function setByline($byline)
    {
        if (!empty($byline)) {
            $this->data['byline'] = $byline;
        }
    }

    private function addRoundedClass($rounded)
    {
        if (!empty($rounded)) {
            $this->data['classList'][] = $this->getBaseClass('radius-' . $rounded, true);
        }
    }

    /**
     * Reduce focus point to a string
     * 
     * @param array $focusPoint
     * 
     * @return string
     */
    private function reduceFocusPoint(array $focusPoint): string
    {
        return implode(" ", array_map(function ($value) {
            return "{$value}%";
        }, $focusPoint));
    }

    /**
     * Get the extension of a file
     * 
     * @param string $src
     * 
     * @return string
     */
    private function getExtension(?string $src): ?string
    {
        if ($src && $extension = pathinfo($src, PATHINFO_EXTENSION)) {
            return $extension;
        }
        return null;
    }
}
