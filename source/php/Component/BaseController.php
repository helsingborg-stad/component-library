<?php

namespace ComponentLibrary\Component;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Filter\Component\AttributeFilter;
use ComponentLibrary\Filter\Component\ClassFilter;
use ComponentLibrary\Filter\Component\DataFilter;
use ComponentLibrary\Filter\Component\FieldFilter;
use ComponentLibrary\Helper\TagSanitizerInterface;
use Illuminate\View\ComponentSlot;

class BaseController
{
    /**
     * Holds the view's data
     * @var array
     */
    protected $data = array(
        'id' => '', //Unique dom id
        'class' => '', //Auto compiled from class list on data fetch
        'baseClass' => '',
        'classList' => [], //An array of class names (push classes here),
        'attribute' => '',
        'attributeList' => [],
        'context' => [],
        'isBlock' => false,
        'isShortcode' => false,
    );

    /**
     * Unique id
     * @var array
     */
    private $uid = null;

    protected array $compParams;

    /**
     * Namespace-derived values are identical for every instance of a component
     * controller class, so resolve them only once per request.
     */
    private static array $namespacePartsCache = [];
    private static array $filterNameCache = [];
    private static array $defaultContextCache = [];

    /**
     * Run init
     */
    public function __construct(
        $data,
        protected CacheInterface $cache,
        protected TagSanitizerInterface $tagSanitizer,
    ) {
        //Load input data
        if (!is_null($data) && is_array($data)) {
            if (isset($data['class']) && !array_key_exists('classList', $data)) {
                $data['classList'] = ComponentDataStrings::parseClasses($data['class']);
            }
            if (isset($data['attribute']) && !array_key_exists('attributeList', $data)) {
                $data['attributeList'] = ComponentDataStrings::parseAttributes($data['attribute']);
            }
            $this->data = array_merge($this->data, $data);
        }

        $this->synchronizePairs($this->data, []);

        //Add default context
        if (is_array($this->data['context'])) {
            $this->data['context'][] = $this->createDefaultContext($this);
        } elseif (is_string($this->data['context'])) {
            $this->data['context'] = [
                $this->data['context'],
                $this->createDefaultContext($this),
            ];
        }

        $this->data = (new DataFilter(
            $this,
            $this->createFilterName($this),
            fn(array $data, array $before): array => $this->synchronizeFilteredData($data, $before),
        ))->apply($this->data);

        //Run
        $this->init();
    }

    /**
     * Returns the data
     *
     * @return array Data
     */
    public function getData()
    {
        //Store locally
        $data = $this->data;

        //Generate classes string
        $data['classList'] = $this->getClass(false);
        $data['class'] = implode(' ', $data['classList']);

        $data['baseClass'] = $this->getBaseClass();

        //Create attibute string
        $data['attributeList'] = $this->getAttribute(false);
        $data['attribute'] = self::buildAttributes($data['attributeList']);

        $this->synchronizePairs($data, $data);

        //Create id strings
        $data['id'] = $this->getId(); //"static" id dependent on the content
        $data['uid'] = $this->getUid(); //"random" id

        //Public methods accesible within views
        $data['buildAttributes'] = function ($attributes = array()) {
            if (!is_array($attributes) || empty($attributes)) {
                return (string) '';
            }

            return (string) self::buildAttributes($attributes);
        };

        $data = (new FieldFilter(
            $this->createFilterName($this),
            fn(array $data, array $before): array => $this->synchronizeFilteredData($data, $before),
        ))->apply($data);

        //Return manipulated data array
        return (array) $data;
    }

    /** Reconcile a filter result with the data passed to that filter. */
    private function synchronizeFilteredData(array $data, array $before): array
    {
        $this->synchronizePairs($data, $before);
        return $data;
    }

    /**
     * Synchronize list and string representations after a data filter.
     *
     * When both representations change, the list takes precedence.
     *
     * @param array $data Component data to synchronize in place.
     * @param array $before Component data before the filter was applied.
     * @return void
     */
    private function synchronizePairs(array &$data, array $before): void
    {
        foreach (['classList' => 'class', 'attributeList' => 'attribute'] as $list => $string) {
            $listChanged = array_key_exists($list, $data) && (!array_key_exists($list, $before) || $data[$list] !== $before[$list]);
            $stringChanged = array_key_exists($string, $data) && (!array_key_exists($string, $before) || $data[$string] !== $before[$string]);

            if (!$listChanged && $stringChanged && is_string($data[$string])) {
                if ($list === 'classList') {
                    $data[$list] = ComponentDataStrings::parseClasses($data[$string]);
                } else {
                    $data[$list] = ComponentDataStrings::parseAttributes($data[$string]);
                }
            }
            $data[$list] = is_array($data[$list] ?? null) ? $data[$list] : [];
            $data[$list] = $list === 'classList'
                ? ComponentDataStrings::classes($data[$list])
                : ComponentDataStrings::attributes($data[$list]);
            $data[$string] = $list === 'classList'
                ? implode(' ', $data[$list])
                : self::buildAttributes($data[$list]);
        }
    }

    /**
     * Returns set or dynamic id
     *
     * @return string Id of the component
     */
    private function getId()
    {
        if (isset($this->data['id']) && !empty($this->data['id'])) {
            return (string) str_replace(' ', '', $this->data['id']);
        }
        return '';
    }

    /**
     * Returns and sets a dynamic id
     *
     * @return string Random id
     */
    public function getUid()
    {
        if (!is_null($this->uid)) {
            return $this->uid;
        }
        return $this->uid = uniqid();
    }

    /**
     * Checks if the specified slot contains data.
     *
     * @param string $slotKey The key of the slot to check.
     * @return bool True if the slot has data, false otherwise.
     */
    public function slotHasData($slotKey)
    {
        if (!isset($this->data[$slotKey]) || !is_object($this->data[$slotKey])) {
            return false;
        }

        if ($this->data[$slotKey] instanceof ComponentSlot) {
            return trim((string) $this->data[$slotKey]) !== '';
        }

        $property = $slotKey === 'slot' ? 'html' : 'contents';
        $value = $this->accessProtected($this->data[$slotKey], $property);

        return !empty($value);
    }

    /**
     * Get all parts of the namespace as an array
     *
     * @return array An array of namespace parts
     */
    private function getNamespaceParts()
    {
        $className = get_class($this);

        if (!isset(self::$namespacePartsCache[$className])) {
            self::$namespacePartsCache[$className] = explode("\\", $className);
        }

        return self::$namespacePartsCache[$className];
    }

    /**
     * Validate that all classes in classlist have their
     * own array item. Also check for empty values.
     *
     * @param array $classList
     * @return bool
     */
    private function validClassList($classList): bool
    {
        if (is_array($classList)) {
            $classList = array_filter($classList);
        }

        if (is_array($classList) && !empty($classList)) {
            foreach ($classList as $classListItem) {
                if (strpos($classListItem, ' ')) {
                    return false;
                }
                if (empty($classListItem)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Returns the classes
     *
     * @return string Css classes
     */
    private function getClass($implode = true, bool $applyFilters = true)
    {
        if (!$this->validClassList($this->data['classList'])) {
            trigger_error(
                sprintf(
                    'The parameter classList is not allowed to contain spaces or include empty strings. 
                    Multiple classes may be separated by entering a array of items.
                    Please review data inputted: %s',
                    print_r($this, true),
                ),
                E_USER_WARNING,
            );
        }

        //Store locally
        if (isset($this->data['classList']) && is_array($this->data['classList'])) {
            $class = $this->data['classList'];
            array_unshift($class, (string) $this->getBaseClass());
        } else {
            $class = array();
        }

        $namespaceParts = $this->getNameSpaceParts();
        $componentName = end($namespaceParts);

        $class = (new ClassFilter($componentName, $this->getBaseClass(), $this->data['context']))->apply($class, $applyFilters);

        //Return manipulated classes as array
        if ($implode === false) {
            return (array) $class;
        }

        //Return manipulated data array as string
        return (string) implode(' ', (array) $class);
    }

    /**
     * Get setting of container awareness
     *
     * @return boolean Boolean to indicate if container awareness is on or off
     */
    private function getContainerAware()
    {
        //Store locally
        if (isset($this->data['containerAware'])) {
            return (bool) $this->data['containerAware'];
        } else {
            return false;
        }
    }

    /**
     * Returns the first class assigned, used as base class
     *
     * @return string A single css class
     */
    protected function getBaseClass(string $className = '', bool $isModifier = false): string
    {
        //If base class is specified from component controller then use that
        if ($this->data['baseClass']) {
            return $this->data['baseClass'];
        }

        //Create string
        $namespaceParts = $this->getNamespaceParts();

        //Separator notation
        $separator = $isModifier ? '--' : '__';

        //Create array of items
        return strtolower(
            implode(
                '',
                [
                    'c-',
                    end($namespaceParts),
                    $className ? $separator : '',
                    $className,
                ],
            ),
        );
    }

    private function getAttribute($implode = true, bool $applyFilters = true)
    {
        //Store locally
        if (isset($this->data['attributeList']) && is_array($this->data['attributeList'])) {
            $attribute = (array) $this->data['attributeList'];
        } else {
            $attribute = array();
        }

        //Add id if defined
        if (!empty($this->data['id'])) {
            $attribute['id'] = $this->sanitizeIdAttribute($this->data['id']);
        }

        //Add attribute for container awareness
        if ($this->getContainerAware() == true) {
            $attribute['data-observe-resizes'] = '';
        }

        $attribute = (new AttributeFilter($this->createFilterName($this)))->apply($attribute, $applyFilters);

        //Sanitize "broken" css.
        if (isset($attribute['style'])) {
            $attribute['style'] = trim($this->sanitizeInlineCss($attribute['style']));
        }

        //Add component slug data attribute unless a component deliberately
        //provides a canonical alias. This is useful when a legacy PHP
        //namespace cannot express the public component name (for example,
        //CollapsibleSearch vs. collapsible-search).
        if (empty($attribute['data-component'])) {
            $attribute['data-component'] = $this->getComponentSlug();
        }

        //Remove empty style attrs
        if (empty($attribute['style'])) {
            unset($attribute['style']);
        }

        //Remove empty aria attributes
        if (empty($attribute['aria-labelledby'])) {
            unset($attribute['aria-labelledby']);
        }

        if (empty($attribute['aria-label'])) {
            unset($attribute['aria-label']);
        }

        //Return manipulated classes as array
        if ($implode === false) {
            return (array) $attribute;
        }

        //Return manipulated data array as string
        return (string) self::buildAttributes($attribute);
    }

    /**
     * Santitize the id attribute of a component
     *
     * This will prevent invalid characters and ensure that the id
     * starts with a letter as required by the HTML spec.
     *
     * @param string $id    The id to sanitize
     * @return string       The sanitized id
     */
    public function sanitizeIdAttribute(string $id): string
    {
        // Allow a-z, A-Z, 0-9, -, _, [, ], {, }
        $id = preg_replace('/[^a-zA-Z0-9\-\_\[\]\{\}]/', '', $id);

        if (!preg_match('/^[a-zA-Z]/', $id)) {
            $id = 'id_' . $id;
        }
        return $id;
    }

    /**
     * Removes empty css properties
     *
     * @param string $inlineCss
     * @return string $inlineCss
     */
    public function sanitizeInlineCss($inlineCss)
    {
        return preg_replace('/.*:\s*;/i', '', $inlineCss);
    }

    /**
     * Builds a string of attributes.
     *
     * @param array $attributes An array of attributes to be added to the string.
     * @return string A string of attributes.
     */
    public static function buildAttributes(array $attributes): string
    {
        $attributeStrings = [];

        foreach ($attributes as $key => $value) {
            if (is_resource($value) || !is_string($value) && is_callable($value)) {
                continue;
            }

            if (is_object($value) || is_array($value)) {
                $value = json_encode($value);
            }

            if (is_numeric($value)) {
                $value = (string) $value;
            }

            if (is_bool($value)) {
                $value = $value ? '1' : '0';
            }

            if ($value === 'null' || $value === null) {
                $escapedValue = '';
            } else {
                $escapedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }

            $attributeStrings[] = "$key=\"$escapedValue\"";
        }

        return implode(' ', $attributeStrings);
    }

    public static function buildInlineStyle($styles)
    {
        return (string) implode(
            ' ',
            array_map(
                function ($v, $k) {
                    return sprintf('%s: %s;', $k, $v);
                },
                array_values($styles),
                array_keys($styles),
            ),
        );
    }

    /**
     * Creates a filter name
     *
     * @return string
     */
    public function createFilterName($class)
    {
        $className = get_class($class);

        if (isset(self::$filterNameCache[$className])) {
            return self::$filterNameCache[$className];
        }

        //Get all parts of the location
        $name = explode(
            "\\",
            $className,
        );

        //Remove duplicates
        $name = array_unique($name);

        //Create string
        return self::$filterNameCache[$className] = implode(DIRECTORY_SEPARATOR, $name);
    }

    /**
     * Creates a context name
     *
     * @return string
     */
    private function createDefaultContext($class)
    {
        $className = get_class($class);

        if (isset(self::$defaultContextCache[$className])) {
            return self::$defaultContextCache[$className];
        }

        //Get all parts of the location
        $name = explode(
            "\\",
            $className,
        );

        if (isset($name[0])) {
            unset($name[0]);
        }

        //Remove duplicates
        $name = array_unique($name);

        //Create string
        return self::$defaultContextCache[$className] = strtolower(implode('.', $name));
    }

    /**
     * Get the slug of the component
     *
     * @return string
     */
    private function getComponentSlug(): string
    {
        $namespaceParts = $this->getNamespaceParts();
        return strtolower(end($namespaceParts)) ?? '';
    }

    /**
     * Proxy for accessing private props
     *
     * @return string Array of values
     */
    public function accessProtected($obj, $prop)
    {
        try {
            $reflection = new \ReflectionClass($obj);
            $property = $reflection->getProperty($prop);
            $property->setAccessible(true);
            return $property->getValue($obj);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
