<?php

namespace ComponentLibrary\Component\Icon;

use Composer\InstalledVersions;
use ComponentLibrary\Helper\Icons;

/**
 * Class Icon
 * @package ComponentLibrary\Component\Icon
 */
class Icon extends \ComponentLibrary\Component\BaseController
{
    private $altTextPrefix = 'Icon: ';
    private $altText = [
        'key' => 'Label',
    ];
    private $altTextUndefined = 'Undefined';
    private static $runtimeCache = [
        'svgFromFile' => [],
        'materialSvg' => [],
    ];

    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Use a runtime cache to store the custom icons
        if (!self::$runtimeCache['svgFromFile']) {
            $customSvgIcons = self::$runtimeCache['svgFromFile'] = (new Icons($this->cache))->getIcons();
        } else {
            $customSvgIcons = self::$runtimeCache['svgFromFile'];
        }

        // The check below handles a default hidden value.
        // Allows for the default value to be overwritten.
        if (is_null($filled)) {
            $this->data['filled'] = $defaultFilled ?? true;
        }

        //Support for filled custom icons. Material SVGs use the selected style.
        $customIconName = $filled ? $icon . 'Filled' : $icon;

        $this->data['svgFromLink'] = $this->iconIsSvg($icon);

        if ($this->data['svgFromLink']) {
            $this->data['classList'][] = $this->getBaseClass() . '--svg-link';
        } elseif (array_key_exists($customIconName, $customSvgIcons)) {
            $this->data['svgElementFromFile'] = $customSvgIcons[$customIconName];
            $this->data['classList'][] = $this->getBaseClass() . '--svg-path';
        } else {
            $this->data['svgElementFromFile'] = self::materialSvg($icon, $variant, $weight);
            $this->data['classList'] = array_merge($this->data['classList'] ?? [], [
                $this->createIconModifier($icon),
                $this->getBaseClass() . '--material',
                $this->getBaseClass() . '--material-' . $icon,
                $this->getBaseClass() . '--svg-material',
            ]);
        }

        if (!empty($customColor)) {
            $this->data['attributeList']['style'] = 'color:' . $customColor . ';' . 'stroke:' . $customColor . ';';
        } else {
            $this->data['classList'][] = $this->setIconColorCssClass($color);
        }

        $this->data['label'] = $this->getSpacedLabel($label);
        $this->data['classList'][] = $this->setIconSizeCssClass($size);

        //Identify as an image
        $this->data['attributeList']['role'] = 'img';
        $this->data['attributeList']['data-nosnippet'] = '';
        $this->data['attributeList']['translate'] = 'no';

        $this->data['attributeList']['aria-label'] = $decorative ? '' : $this->getAltText($icon);
        $this->data['attributeList']['aria-hidden'] = $decorative ? 'true' : 'false';

        //If is placeholder, do not read.
        if ($icon == 'placeholder') {
            $this->data['attributeList']['aria-hidden'] = 'true';
            $this->data['attributeList']['aria-label'] = '';
        }
    }

    private static function materialSvg($icon, string $variant, int $weight): string
    {
        if (!is_string($icon) || !preg_match('/^[a-z0-9_]+$/', $icon)) {
            return '';
        }

        $variant = in_array($variant, ['outlined', 'rounded', 'sharp'], true) ? $variant : 'outlined';
        $weight = in_array($weight, [200, 400, 600], true) ? $weight : 400;

        $key = $variant . '/' . $weight . '/' . $icon;
        if (isset(self::$runtimeCache['materialSvg'][$key])) {
            return self::$runtimeCache['materialSvg'][$key];
        }

        $package = InstalledVersions::getInstallPath('helsingborg-stad/material-design-icons-json-svg-font-reduced');
        $path = $package . '/' . $key . '.svg';
        $svg = is_file($path) ? file_get_contents($path) : '';
        $svg = is_string($svg)
            ? preg_replace('/^<svg\b/', '<svg aria-hidden="true" focusable="false"', $svg, 1)
            : '';
        return self::$runtimeCache['materialSvg'][$key] = $svg ?? '';
    }

    private function iconIsSvg($icon)
    {
        if (!is_string($icon)) {
            return false;
        }

        return str_ends_with($icon, '.svg') !== false;
    }

    /**
     * Creates a modifier based on the icon name.
     *
     * @param string $icon
     *
     * @return string
     */
    private function createIconModifier($icon)
    {
        if (is_null($icon)) {
            return '';
        }

        return $this->getBaseClass(
            str_replace('_', '-', $icon),
            true,
        );
    }

    /**
     * Get a filtered alt text prefix
     *
     * @return string
     */
    private function altTextPrefix(): string
    {
        if (function_exists('apply_filters')) {
            return apply_filters($this->createFilterName($this) . '/' . ucfirst(__FUNCTION__), $this->altTextPrefix);
        }
        return $this->altTextPrefix;
    }

    /**
     * Get a filtered alt text array
     *
     * @return array
     */
    private function altText(): array
    {
        if (function_exists('apply_filters')) {
            return apply_filters($this->createFilterName($this) . '/' . ucfirst(__FUNCTION__), $this->altText);
        }
        return $this->altText;
    }

    /**
     * Get a filtered undefined alt text.
     *
     * @return string
     */
    private function altTextUndefined(): string
    {
        if (function_exists('apply_filters')) {
            return apply_filters($this->createFilterName($this) . '/' . ucfirst(__FUNCTION__), $this->altTextUndefined);
        }
        return $this->altTextUndefined;
    }

    /**
     * Find and add a label to each icon.
     *
     * @param string $icon
     * @return string
     */
    private function getAltText($icon)
    {
        if (array_key_exists($icon, $this->altText())) {
            return $this->altTextPrefix() . $this->altText()[$icon];
        }
        return $this->altTextPrefix() . $this->altTextUndefined();
    }

    private function getSpacedLabel($label)
    {
        if ($label = trim($label)) {
            $label = ' ' . $label;
        }

        return $label;
    }

    private function setIconColorCssClass($color)
    {
        return !empty($color) ? $this->getBaseClass() . '--color-' . strtolower($color) : '';
    }

    private function setIconSizeCssClass($size)
    {
        $sizes = [
            'xs' => '16',
            'sm' => '24',
            'md' => '32',
            'lg' => '48',
            'xl' => '64',
            'xxl' => '80',
        ];

        return isset($sizes[$size])
            ? $this->getBaseClass() . '--size-' . $size
            : $this->getBaseClass() . '--size-inherit';
    }
}
