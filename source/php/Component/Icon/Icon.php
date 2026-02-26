<?php

namespace ComponentLibrary\Component\Icon;

use ComponentLibrary\Helper\Icons;

/**
 * Class Icon
 * @package ComponentLibrary\Component\Icon
 */
class Icon extends \ComponentLibrary\Component\BaseController implements IconInterface
{
    private $altTextPrefix = "Icon: ";
    private $altText = [
        'key'  => "Label"
    ];
    private $altTextUndefined = "Undefined";
    private static $runtimeCache = [
        'svgFromFile' => []
    ];

    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        //Use a runtime cache to store the custom icons
        if(!self::$runtimeCache['svgFromFile']) {
            $customSvgIcons = self::$runtimeCache['svgFromFile'] = (
                new Icons($this->cache)
            )->getIcons();
        } else {
            $customSvgIcons = self::$runtimeCache['svgFromFile'];
        }

        // The check below handles a default hidden value.
        // Allows for the default value to be overwritten.
        if (is_null($filled)) {
            $this->data['filled'] = $defaultFilled ?? true;
        }

        //Support for filled icons 
        $customIconName = $filled ? $icon . 'Filled' : $icon;

        $this->data['svgFromLink'] =  $this->iconIsSvg($icon);

        if ($this->data['svgFromLink']) {
            $this->data['classList'][] = $this->getBaseClass() . "--svg-link";
        } elseif (array_key_exists($customIconName, $customSvgIcons)) {
            $this->data['svgElementFromFile'] = $customSvgIcons[$customIconName];
            $this->data['classList'][] = $this->getBaseClass() . "--svg-path";
        } else {
            $this->data['classList'] = array_merge($this->data['classList'] ?? [], [
                $this->createIconModifier($icon),
                $this->getBaseClass() . "--material",
                $this->getBaseClass() . "--material-" . $icon,
                "material-symbols",
                "material-symbols-rounded", //All classes added, to support all icon types
                "material-symbols-sharp", //All classes added, to support all icon types
                "material-symbols-outlined" //All classes added, to support all icon types
            ]);
            $this->data['attributeList']['data-material-symbol'] = $icon;
        }

        if (!empty($filled)) {
            $this->data['classList'][] = 'material-symbols--filled';
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
        $this->data['attributeList']['aria-hidden'] = $decorative ? "true" : "false";

        //If is placeholder, do not read. 
        if($icon == "placeholder") {
            $this->data['attributeList']['aria-hidden'] = "true";
            $this->data['attributeList']['aria-label'] = "";
        }
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
    // -------------------------------------------------------------------------
    // ComponentInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSlug(): string
    {
        return 'icon';
    }

    // -------------------------------------------------------------------------
    // IconInterface — generated getters
    // -------------------------------------------------------------------------

    public function getSize(): string
    {
        return $this->data['size'] ?? 'inherit';
    }

    public function getLabel(): string
    {
        return $this->data['label'] ?? '';
    }

    public function getIcon(): string
    {
        return $this->data['icon'] ?? '';
    }

    public function getColor(): string
    {
        return $this->data['color'] ?? '';
    }

    public function getCustomColor(): string
    {
        return $this->data['customColor'] ?? '';
    }

    public function getComponentElement(): string
    {
        return $this->data['componentElement'] ?? 'span';
    }

    public function getFilled(): bool
    {
        return $this->data['filled'] ?? null;
    }

    public function getDecorative(): bool
    {
        return $this->data['decorative'] ?? false;
    }
}
