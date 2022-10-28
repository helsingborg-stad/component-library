<?php

namespace ComponentLibrary\Component\Icon;

/**
 * Class Icon
 * @package ComponentLibrary\Component\Icon
 */
class Icon extends \ComponentLibrary\Component\BaseController {
    private $altTextPrefix = "Icon: ";
    private $altText = [
        'key'  => "Label",
    ];
    private $altTextUndefined = "Undefined";

    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        // Make data accessible
        $this->compParams = [
            'label'     => $label,
            'color'     => $color,
            'size'      => $size
        ];

        $this->setColor();
        $this->appendSpace();
        $this->setSize();

        //Set material icon class
        $this->data['classList'][] = "material-icons";

        //Do not translate the icon
        $this->data['attributeList']['translate'] = "no";

        //Identify as an image
        $this->data['attributeList']['role'] = "img";
        $this->data['attributeList']['aria-label'] = $this->getAltText($icon);
        $this->data['attributeList']['alt'] = $this->getAltText($icon);
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

    /**
     * Appends space before label
     * @return array
     */
    public function appendSpace()
    {
        if ($this->compParams['label'] = trim($this->compParams['label'])) {
            $this->data['label'] = " " . $this->compParams['label'];
        }

        return $this->data;
    }

    /**
     * Build class for color
     * @return array
     */
    public function setColor() {
        // Set color based on provided name
        if (isset($this->compParams['color']) && !empty($this->compParams['color'])) {
            $this->data['classList'][] = $this->getBaseClass() . "--color-" . strtolower($this->compParams['color']);
        }

        return $this->data;
    }


    /**
     * Build class for size
     * @return array
     */
    public function setSize() {
        //Available sizes
        $sizes = [
            'xs' => '16',
            'sm' => '24',
            'md' => '32',
            'lg' => '48',
            'xl' => '64',
            'xxl' => '80',
        ];

        //Size class
        if (isset($sizes[$this->compParams['size']])) {
            $this->data['classList'][] = $this->getBaseClass() . "--size-" . $this->compParams['size'];
        } else {
            $this->data['classList'][] = $this->getBaseClass() . "--size-inherit";
        }

        return $this->data;
    }
}
