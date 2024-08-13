<?php

namespace ComponentLibrary\Component;

use ComponentLibrary\Cache\CacheInterface;

class BaseController
{
    /**
     * Holds the view's data
     * @var array
     */
    protected $data = array(
        'id' => '', //Unique dom id
        'class' => "", //Auto compiled from class list on data fetch
        'baseClass' => "",
        'classList' => [], //An array of class names (push classes here),
        'attribute' => "",
        'attributeList' => [],
        'context' => []
    );

    /**
     * Unique id
     * @var array
     */
    private $uid = null;

    protected array $compParams;

    /**
     * Run init
     */
    public function __construct($data, protected CacheInterface $cache)
    {
        //Load input data
        if (!is_null($data) && is_array($data)) {
            $this->data = array_merge($this->data, $data);
        }

        //Add default context
        if (is_array($this->data['context'])) {
            $this->data['context'][] = $this->createDefaultContext($this);
        } elseif (is_string($this->data['context'])) {
            $this->data['context'] = [
                $this->data['context'],
                $this->createDefaultContext($this)
            ];
        }

        //Applies a general wp filter
        if (function_exists('apply_filters')) {
            $this->data = apply_filters("ComponentLibrary/Component/Data", $this->data);
        }

        //Applies a general wp filter
        if (function_exists('apply_filters')) {
            $this->data = apply_filters($this->createFilterName($this) . DIRECTORY_SEPARATOR . "Data", $this->data);
        }

        if (function_exists('apply_filters')) {
            $this->data['lang'] = apply_filters('ComponentLibrary/Component/Lang', $this->data['lang'] ?? []);
        }

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
        $data['class'] = $this->getClass();

        $data['baseClass'] = $this->getBaseClass();

        //Create attibute string
        $data['attribute'] = $this->getAttribute();

        //Create id strings
        $data['id'] = $this->getId(); //"static" id dependent on the content
        $data['uid'] = $this->getUid(); //"random" id

        //Key for if slot contains any data
        $data['slotHasData'] = isset($this->data['slot']) && !empty($this->accessProtected($this->data['slot'], "html"));

        //Public methods accesible within views
        $data['buildAttributes'] = function ($attributes = array()) {
            if (!is_array($attributes) || empty($attributes)) {
                return (string) '';
            }

            return (string) self::buildAttributes($attributes);
        };

        //Applies single filter for each data item (class and data exepted)
        if (function_exists('apply_filters')) {
            if (is_array($data) && !empty($data)) {
                foreach ($data as $key => $item) {
                    if (!in_array($key, array("data", "classes", 'class'))) {
                        $data[$key] = apply_filters(
                            $this->createFilterName($this) . DIRECTORY_SEPARATOR . ucfirst($key), 
                            $data[$key],
                            $data['context'] ?? []
                        );
                    }
                }
            }
        }

        //Return manipulated data array
        return (array) $data;
    }

    /**
     * Returns set or dynamic id
     *
     * @return string Id of the component
     */
    private function getId()
    {
        if (isset($this->data['id']) && !empty($this->data['id'])) {
            return (string) strtolower($this->data['id']);
        }
        return "";
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
    * If the slot exists in the data array, and the html property of the slot is not empty, then
    * return true
    * 
    * @param slotKey The name of the slot you want to check.
    * 
    * @return a boolean value.
    */
    public function slotHasData($slotKey) 
    {
        if (!array_key_exists($slotKey, $this->data)) {
            return false;
        }

        if (empty($this->accessProtected($this->data[$slotKey], "contents"))) {
            return false;
        }
        return true;
    }

    private function getNamespaceParts()
    {
        //Get all parts of the location
        return explode(
            "\\",
            get_called_class()
        );
    }

    private function setModifier($class, $modifier)
    {
        if (!empty($modifier)) {
            foreach ($modifier as &$value) {
                if ($value) {
                    $class[] =  $this->getBaseClass() . '--' . $value;
                }
            }
        }

        return $class;
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
                if (strpos($classListItem, " ")) {
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
    private function getClass($implode = true)
    {
        if (!$this->validClassList($this->data['classList'])) {
            trigger_error(
                sprintf(
                    'The parameter classList is not allowed to contain spaces or include empty strings. 
                    Multiple classes may be separated by entering a array of items.
                    Please review data inputted: %s',
                    print_r($this, true)
                ),
                E_USER_WARNING
            );
        }

        //Store locally
        if (isset($this->data['classList']) && is_array($this->data['classList'])) {
            array_unshift(
                $this->data['classList'],
                (string) $this->getBaseClass()
            );
            $class = (array) $this->data['classList'];
        } else {
            $class = array();
        }

        $namespaceParts =  $this->getNameSpaceParts();
        $componentName = end($namespaceParts);

        //Applies a general wp filter
        if (function_exists('apply_filters')) {
            $modifier = apply_filters("ComponentLibrary/Component/Modifier", [], $this->data['context']);
            $class = $this->setModifier($class, $modifier);
        }

        //Applies component specific wp filter
        if (function_exists('apply_filters')) {
            $modifier = apply_filters("ComponentLibrary/Component/". $componentName ."/Modifier", [], $this->data['context']);
            $class = $this->setModifier($class, $modifier);
        }

        //Applies a general wp filter
        if (function_exists('apply_filters')) {
            $class = apply_filters("ComponentLibrary/Component/Class", $class);
        }

        //Applies component specific wp filter
        if (function_exists('apply_filters')) {
            $class = apply_filters("ComponentLibrary/Component/". $componentName ."/Class", $class, $this->data['context']);
        }

        //Return manipulated classes as array
        if ($implode === false) {
            return (array) $class;
        }

        //Return manipulated data array as string
        return (string) implode(" ", (array) $class);
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
    protected function getBaseClass(string $className = "", bool $isModifier = false): string
    {
        //If base class is specified from component controller then use that
        if ($this->data['baseClass']) {
            return $this->data['baseClass'];
        }

        //Create string
        $namespaceParts = $this->getNamespaceParts();

        //Separator notation
        $separator = ($isModifier ? '--' : '__'); 

        //Create array of items
        return strtolower(
            implode(
                "",
                [
                    "c-",
                    end($namespaceParts),
                    ($className ? $separator : ''),
                    $className
                ]
            )
        );
    }

    private function getAttribute($implode = true)
    {
        //Store locally
        if (isset($this->data['attributeList']) && is_array($this->data['attributeList'])) {
            $attribute = (array) $this->data['attributeList'];
        } else {
            $attribute = array();
        }

        //Add attribute for container awareness
        if ($this->getContainerAware() == true) {
            $attribute['data-observe-resizes'] = "";
        }

        //Add id if defined
        if (!empty($this->data['id'])) {
            $attribute['id'] = $this->data['id'];
        }

        //Add unique id
        $attribute['data-uid'] = $this->getUid();

        //Applies a general wp filter
        if (function_exists('apply_filters')) {
            $attribute = apply_filters($this->createFilterName($this) . DIRECTORY_SEPARATOR . "Attribute", $attribute);
        }

        //Applies a general wp filter
        if (function_exists('apply_filters')) {
            $attribute = apply_filters("ComponentLibrary/Component/Attribute", $attribute);
        }

        //Sanitize "broken" css.
        if (isset($attribute['style'])) {
            $attribute['style'] = trim($this->sanitizeInlineCss($attribute['style']));
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

            if(is_resource($value) || is_callable($value)) {
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

            if($value === "null" || $value === null) {
                $escapedValue = "";
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
                array_keys($styles)
            )
        );
    }

    /**
     * Creates a filter name
     *
     * @return string
     */
    public function createFilterName($class)
    {
        //Get all parts of the location
        $name = explode(
            "\\",
            get_class($class)
        );

        //Remove duplicates
        $name = array_unique($name);

        //Create string
        return implode(DIRECTORY_SEPARATOR, $name);
    }

    /**
     * Creates a context name
     *
     * @return string
     */
    private function createDefaultContext($class)
    {
        //Get all parts of the location
        $name = explode(
            "\\",
            get_class($class)
        );

        if (isset($name[0])) {
            unset($name[0]);
        }

        //Remove duplicates
        $name = array_unique($name);

        //Create string
        return strtolower(implode(".", $name));
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
        } catch (\Exception $e) {
            return false;
        }
    }
}
