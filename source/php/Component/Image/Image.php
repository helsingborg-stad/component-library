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

        foreach (['width', 'height'] as $dimension) {
            $value = $this->data['imgAttributeList'][$dimension] ?? null;
            if ($value !== null && (!is_numeric($value) || (int) $value <= 0)) {
                unset($this->data['imgAttributeList'][$dimension]);
            }
        }

        // Handle image processing
        if ($this->data['src'] instanceof ImageInterface) {
            $this->handleImageProcessing(
                $this->data['src'],
                $this->data['alt'],
                $this->data['lqipEnabled'],
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
            $this->data['src'],
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
        $imgAttributeList = $this->data['imgAttributeList'];
        if ($this->data['containerQueryData']) {
            // Each candidate has its own dimensions in the container-query template.
            unset($imgAttributeList['width'], $imgAttributeList['height']);
        }
        $this->data['imgAttributes'] = self::buildAttributes($imgAttributeList);

        // Build wrapper attributes
        if (!isset($this->data['wrapperAttributes'])) {
            $this->data['wrapperAttributes'] = [];
        }
        $this->data['wrapperAttributes'] = self::buildAttributes($this->data['wrapperAttributes']);

        // Add class if alt-text is missing
        if (empty($this->data['alt']) && (!empty($placeholderEnabled) && !empty($placeholderIcon))) {
            $this->data['attributeList']['data-a11y-error'] = 'Alt text is missing';
        }
    }

    private function addPlaceholderClass($src)
    {
        if (!$src) {
            $this->data['classList'][] = $this->getBaseClass() . '--is-placeholder';
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
        $this->data['src'] = $imageUrl;
        $this->data['srcset'] = $src->getSrcSet();
        $focusPoint = $src->getFocusPoint();
        $this->data['focus'] = sprintf('object-position: %s;', $this->reduceFocusPoint($focusPoint));

        if (isset($this->data['preferSrcset']) && $this->data['preferSrcset']) {
            // Render a single <img>, letting the browser pick a candidate via srcset/sizes.
            // Container query data still supplies the wrapper's aspect ratio below.
            $this->data['containerQueryData'] = null;
            $this->addResponsiveImageAttributes($containerQueryData, $this->data['srcset'], $this->data['focus']);
        } else {
            // Default: one <img> per candidate size, switched by CSS container queries.
            $this->data['containerQueryData'] = $containerQueryData;
            if (is_array($containerQueryData) && !empty($containerQueryData)) {
                $this->data['classList'][] = $this->getBaseClass('container-query', true);
                foreach ($this->data['containerQueryData'] as &$item) {
                    $item['dimensions'] = $this->resolveDimensionsFromCandidate($item)
                        ?? $this->resolveDimensionsFromAttributes();
                }
                unset($item);
            }
        }

        if (empty($alt)) {
            $alt = $this->data['alt'] = $src->getAltText();
        }

        //Add aspect ratio, if not in cover mode or calculateAspectRatio is false.
        if (!$this->data['cover'] && $this->data['calculateAspectRatio']) {
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
            $this->data['wrapperAttributes']['style'] = '';
        }

        $aspectRatio = $this->resolveAspectRatioFromContainerQueryData($containerQueryData) ?? '16/9';

        $this->data['wrapperAttributes']['style'] .= "aspect-ratio:{$aspectRatio};";
    }

    private function addLowResolutionPlaceholder(string $lqipUrl, array $focusPoint)
    {
        if (!isset($this->data['wrapperAttributes']['style'])) {
            $this->data['wrapperAttributes']['style'] = '';
        }
        $this->data['wrapperAttributes']['style'] .= sprintf(
            'background-image: url(%s); background-position: %s;',
            $lqipUrl,
            $this->reduceFocusPoint($focusPoint),
        );
    }

    private function addSrcsetToAttributes($srcset)
    {
        // Container-query mode renders one <img> per size, each with its own src, no srcset needed.
        if ($srcset && !isset($this->data['containerQueryData'])) {
            $this->data['imgAttributeList']['srcset'] = $srcset;
        }
    }

    /**
     * Keep content images lazy by default and use dimensions encoded in plain URLs
     * when no image metadata or caller-supplied dimensions are available.
     */
    private function addDefaultImageAttributes(): void
    {
        if (!isset($this->data['imgAttributeList']['loading'])) {
            $this->data['imgAttributeList']['loading'] = 'lazy';
        }

        $dimensions = $this->resolveDimensionsFromUrl($this->data['src']);
        $this->addDimensionsToAttributes($dimensions);
    }

    /**
     * Opt-in alternative to the default container-query switching: describes one
     * responsive image instead of rendering one <img> per candidate. Container
     * units retain component-level sizing, while an unsupported sizes value falls
     * back to the HTML default of 100vw. Used for LCP-critical images (e.g. Hero)
     * where downloading only one candidate matters more than an exact size match.
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

        for ($index = count($containerQueryData) - 1; $index >= 0; $index--) {
            $dimensions = $this->resolveDimensionsFromCandidate($containerQueryData[$index]);
            if ($dimensions !== null) {
                $this->addDimensionsToAttributes($dimensions);
                break;
            }
        }
    }

    private function addDimensionsToAttributes(?array $dimensions): void
    {
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

    private function resolveDimensionsFromAttributes(): ?array
    {
        $width = $this->data['imgAttributeList']['width'] ?? null;
        $height = $this->data['imgAttributeList']['height'] ?? null;
        if (is_numeric($width) && is_numeric($height) && (int) $width > 0 && (int) $height > 0) {
            return [(int) $width, (int) $height];
        }

        return null;
    }

    private function resolveDimensionsFromCandidate(array $item): ?array
    {
        $imageSize = $item['imageSize'] ?? null;
        if (is_array($imageSize) && isset($imageSize[0], $imageSize[1])) {
            $width = (int) $imageSize[0];
            $height = (int) $imageSize[1];
            if ($width > 0 && $height > 0) {
                return [$width, $height];
            }
        }

        $aspectRatio = $item['aspectRatio'] ?? null;
        if (is_string($aspectRatio) && preg_match('/^(\d+)\/(\d+)$/', $aspectRatio, $matches)) {
            $width = (int) $matches[1];
            $height = (int) $matches[2];
            if ($width > 0 && $height > 0) {
                return [$width, $height];
            }
        }

        return $this->resolveDimensionsFromUrl($item['url'] ?? null);
    }

    private function resolveDimensionsFromUrl($url): ?array
    {
        if (!is_string($url) || $url === '') {
            return null;
        }

        $path = parse_url($url, PHP_URL_PATH);
        if (!is_string($path)) {
            return null;
        }

        if (preg_match('/(\d{2,5})x(\d{2,5})(?:\D|$)/', $path, $matches)
            || preg_match('~/(\d{2,5})/(\d{2,5})/?$~', $path, $matches)) {
            $width = (int) $matches[1];
            $height = (int) $matches[2];
            if ($width > 0 && $height > 0) {
                return [$width, $height];
            }
        }

        return null;
    }

    private function handleFileTypeClass($src)
    {
        if (is_string($src) && ($extension = $this->getExtension($src))) {
            $this->data['classList'][] = $this->getBaseClass('type-' . $extension, true);
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
            $this->data['alt'] = !empty($caption) ? $caption : '';
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
        return implode(' ', array_map(function ($value) {
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
        if ($src && ($extension = pathinfo($src, PATHINFO_EXTENSION))) {
            return $extension;
        }
        return null;
    }
}
