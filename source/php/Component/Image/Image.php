<?php

namespace ComponentLibrary\Component\Image;

use ComponentLibrary\Integrations\Image\ImageInterface;

class Image extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        // Handle image processing
        if ($this->data['src'] instanceof ImageInterface) {
            $this->handleImageProcessing(
                $this->data['src'],
                $this->data['alt'],
                $this->data['lqipEnabled']
            );
        } else {
            $this->data['containerQueryData'] = null;

            // Add srcset to attribute list, on images
            $this->addSrcsetToAttributes($this->data['srcset']);
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

        // Build img attributes
        $this->data['imgAttributes'] = self::buildAttributes($this->data['imgAttributeList']);

        // Add class if alt-text is missing
        if (empty($this->data['alt'])) {
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
        //If source is SVG, then there is no need to do any container query processing
        if ($this->getExtension($src->getUrl()) === 'svg') {
            $this->data['src'] = $src->getUrl();
            $this->data['classList'][] = $this->getBaseClass('svg-background', true);
            $this->data['containerQueryData'] = null;
            return;
        }

        $this->data['containerQueryData'] = $src->getContainerQueryData();
        $this->data['src'] = $src->getUrl();
        $this->data['srcset'] = $src->getSrcSet();
        $this->data['focus'] = sprintf("object-position: %s;", $this->reduceFocusPoint($src->getFocusPoint()));

        if (empty($alt)) {
            $alt = $this->data['alt'] = $src->getAltText();
        }

        $this->data['classList'][] = $this->getBaseClass('container-query', true);

        //Add aspect ratio, if not in cover mode or calculateAspectRatio is false.
        if(!$this->data['cover'] && $this->data['calculateAspectRatio']) {
            $aspectRatio = $this->resolveAspectRatioFromContainerQueryData($this->data['containerQueryData']);
            if($aspectRatio) {
                if (!isset($this->data['attributeList']['style'])) {
                    $this->data['attributeList']['style'] = "";
                }
                $this->data['attributeList']['style'] .= "aspect-ratio: " . $aspectRatio . ";";
            }
        }

        if ($lqipEnabled && $src->getLqipUrl()) {
            $this->addLowResolutionPlaceholder($src);
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

    private function addLowResolutionPlaceholder(ImageInterface $src)
    {
        if (!isset($this->data['attributeList']['style'])) {
            $this->data['attributeList']['style'] = "";
        }
        $this->data['attributeList']['style'] .= sprintf(
            "background-image: url(%s); background-position: %s;",
            $src->getLqipUrl(),
            $this->reduceFocusPoint($src->getFocusPoint())
        );
    }

    private function addSrcsetToAttributes($srcset)
    {
        if ($srcset) {
            $this->data['attributeList']['srcset'] = $srcset;
        }
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