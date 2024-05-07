<?php

namespace ComponentLibrary\Component\Icon;

/**
 * Class Icon
 * @package ComponentLibrary\Component\Icon
 */
class Icon extends \ComponentLibrary\Component\BaseController
{
    private $altTextPrefix = "Icon: ";
    private $altText = [
        'key'  => "Label"
    ];
    private $altTextUndefined = "Undefined";
    
    private $customIconsSvgPathList = 'customIconsSvgPathList';
    private $customIconsSvgContentList = 'customIconsSvgContentList';
    private static $iconsCache = [
        'customIconsSvgContentList' => [],
        'customIconsSvgPathList' => []
    ];

    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);
        
        $customSvgIcons = $this->getCustomSvgIcons();
        $customIconName = $filled ? $icon . 'Filled' : $icon;

        $this->data['svgFromLink'] =  $this->iconIsSvg($icon);

        if ($this->data['svgFromLink']) {
            $this->data['classList'][] = $this->getBaseClass() . "--svg-link";

        } 
        elseif (array_key_exists($customIconName, $customSvgIcons)) {
            $this->data['svgElementFromFile'] = $this->getCustomIconPath($customSvgIcons[$customIconName], $customIconName);
            $this->data['classList'][] = $this->getBaseClass() . "--svg-path";
        }
        else {
            $this->data['classList'] = array_merge($this->data['classList'] ?? [], [
                $this->createIconModifier($icon),
                $this->getBaseClass() . "--material",
                $this->getBaseClass() . "--material-" . $icon,
                "material-symbols-outlined"
            ]);

            $this->data['attributeList']['material-symbol'] = $icon;
        }

        if (!empty($filled)) {
            $this->data['classList'][] = 'material-symbols-outlined--filled';
        }

        if (!empty($customColor)) {
            $this->data['attributeList']['style'] = 
                'color:' . $customColor . ';' . 
                'stroke:' . $customColor . ';';
        } else {
            $this->data['classList'][] = $this->setIconColorCssClass($color);
        }


        $this->data['label'] = $this->getSpacedLabel($label);
        $this->data['classList'][] = $this->setIconSizeCssClass($size);

        //Identify as an image
        $this->data['attributeList']['role'] = "img";
        $this->data['attributeList']['data-nosnippet'] = "";
        $this->data['attributeList']['translate'] = "no";
        $this->data['attributeList']['aria-label'] = $decorative ? "" : $this->getAltText($icon);
        $this->data['attributeList']['alt'] = $decorative ? "" : $this->getAltText($icon);
        $this->data['attributeList']['aria-hidden'] = $decorative ? "true" : "false";
    }

    private function iconIsSvg($icon)
    {   
        if( !is_string($icon) ) {
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
        if( is_null($icon) ) {
            return "";
        }

        return $this->getBaseClass(
            str_replace("_", "-", $icon),
            true
        );
    }

    private function getCustomIconPath($path, $icon)
    {
        if (!empty(self::$iconsCache[$this->customIconsSvgContentList][$icon])) {
            return self::$iconsCache[$this->customIconsSvgContentList][$icon];
        }

        $useWpCache = function_exists('wp_cache_get') && function_exists('wp_cache_set');

        if ($useWpCache) {
            $cachedIconContent = wp_cache_get($icon, 'customIconsSvgContentList');
            if ($cachedIconContent !== false) {
                self::$iconsCache[$this->customIconsSvgContentList][$icon] = $cachedIconContent;
                return $cachedIconContent;
            }
        }
        
        if (file_exists($path) && is_readable($path)) {
            $contents = file_get_contents($path);
            self::$iconsCache[$this->customIconsSvgContentList][$icon] = $contents;
        }

        if ($useWpCache) {
            wp_cache_set($icon, self::$iconsCache[$this->customIconsSvgContentList][$icon], 'customIconsSvgContentList');
        }

        return self::$iconsCache[$this->customIconsSvgContentList][$icon] ?? null;
    }

    private function getCustomSvgIcons() {
        if (!empty(self::$iconsCache[$this->customIconsSvgPathList])) {
            return self::$iconsCache[$this->customIconsSvgPathList];
        }

        $useWpCache = function_exists('wp_cache_get') && function_exists('wp_cache_set');

        if ($useWpCache) {
            $cachedIconList = wp_cache_get($this->customIconsSvgPathList, 'customIconsSvgPathList');
            if ($cachedIconList !== false) {
                self::$iconsCache[$this->customIconsSvgPathList] = $cachedIconList;
                return $cachedIconList;
            }
        }
  
        if (function_exists('apply_filters')) {
            $svgIcons = apply_filters(
                'ComponentLibrary\Component\Icon\CustomSvgIcons',
                glob(__DIR__ . '/Svg/*.svg')
            );
        } else {
            $svgIcons = glob(__DIR__ . '/Svg/*.svg');
        }

        if (empty($svgIcons)) {
            return [];
        }

        foreach ($svgIcons as $svgIcon) {
            $iconName = pathinfo($svgIcon, PATHINFO_FILENAME);
            self::$iconsCache['icons'][$iconName] = $svgIcon;
        }
    
        if ($useWpCache) {
            wp_cache_set($this->customIconsSvgPathList, self::$iconsCache['icons'], 'customIconsSvgPathList');
        }

        return self::$iconsCache[$this->customIconsSvgPathList];
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

    private function getSpacedLabel($label) {
        if ($label = trim($label)) {
            $label = " " . $label;
        }

        return $label;
    }

    private function setIconColorCssClass($color) {
        return !empty($color) ? $this->getBaseClass() . "--color-" . strtolower($color) : "";
    }

    private function setIconSizeCssClass($size) {
        $sizes = [
            'xs' => '16',
            'sm' => '24',
            'md' => '32',
            'lg' => '48',
            'xl' => '64',
            'xxl' => '80',
        ];

        return isset($sizes[$size]) ? $this->getBaseClass() . "--size-" . $size : $this->getBaseClass() . "--size-inherit";
    }
}
