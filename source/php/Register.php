<?php

namespace ComponentLibrary;

use ComponentLibrary\Cache\CacheInterface;
use HelsingborgStad\BladeService\BladeServiceInterface;
use Illuminate\Support\Facades\Blade;
use Throwable;

class Register
{
    private static $cache = [
        'configJson'        => [],
        'fileExists'        => [],
        'fileGetContents'   => [],
        'glob'              => [],
    ]; 

    public $data;
    public $cachePath = ""; 
    public $viewPaths = [];
    public $controllerPaths = [];
    private $reservedNames = ["data", "class", "list", "lang"];
    private $controllers = [];
    private BladeServiceInterface $blade;
    private CacheInterface $componentCache;

    public function __construct(BladeServiceInterface $bladeService, CacheInterface $componentCache)
    {
        $this->blade = $bladeService;
        $this->componentCache = $componentCache;
    }

    /**
     * Add a new component to the system.
     *
     * @param string $slug The unique identifier for the component.
     * @param array $defaultArgs The default arguments for the component.
     * @param string|null $view The optional view name for the component.
     * @throws \Exception if the provided slug is reserved or invalid.
     */
    public function add($slug, $defaultArgs, $argsTypes = false, $view = null)
    {
        //Create utility data object
        if (is_null($this->data)) {
            $this->data = (object) array();
        }
 
        //Prohibit reserved names
        if (in_array($slug, $this->reservedNames)) {
            throw new \Exception("Invalid slug (" . $slug . ") provided, cannot be used as a view name since it is reserved for internal purposes.");
        }

        //Get view name
        $view = $this->getViewName($slug, $view);

        //Adds to full object
        $this->data->{$slug} = (object) array(
            'slug'       => (string) $slug,
            'args'       => (object) $defaultArgs,
            'view'       => (string) $slug . DIRECTORY_SEPARATOR . $view,
            'controller' => (string) $slug,
            'argsTypes'  => (object) $argsTypes
        );

        $this->blade->registerComponentDirective( ucfirst($slug) . '.' . $slug, $slug);
        $this->registerViewComposer($this->data->{$slug});
    }

    /**
     * Appends the controller path object
     *
     * @return string The updated object with controller paths
     */
    public function addControllerPath($path, $prepend = true): array
    {
        //Sanitize path
        $path = rtrim($path, "/");

        //Push to location array
        if ($prepend === true) {
            if (array_unshift($this->controllerPaths, $path)) {
                return $this->controllerPaths;
            }
        } else {
            if (array_push($this->controllerPaths, $path)) {
                return $this->controllerPaths;
            }
        }

        //Error if something went wrong
        throw new \Exception("Error appending controller path: " . $path);
    }

    /**
     * Registers components directory
     * 
     * @return string The slugs of all registered components
     */
    public function registerInternalComponents($path): array
    {
        //Declare
        $result = array();

        //Sanitize path
        $basePath = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . "*";

        //Glob
        $locations = $this->cachedGlob($basePath);

        //Loop over each path
        if (is_array($locations) && !empty($locations)) {
            foreach ($locations as $path) {

                //Locate config file
                $config = $this->readConfigFile(
                    $this->getConfigFilePath($path)
                );

                //Register the component
                $this->add(
                    $config['slug'],
                    $config['default'],
                    $config['types'] ?? (object) [],
                    $config['view'] ? $config['view'] : $config['slug'] . "blade.php"
                );

                //Log
                $result[] = $config['slug'];
            }
        }

        return $result;
    }

    public function getEngine()
    {
        return $this->blade;
    }

    /**
     * Use defined view or, generate from slug
     * 
     * @return string The view name included filetype
     */
    private function getViewName($slug, $view = null): string
    {
        if (is_null($view)) {
            $view = $slug . '.blade.php';
        }
        return $view;
    }

    public function registerViewComposer(object $component)
    {
        try {
            $this->blade->registerComponent(
                ucfirst($component->slug) . '.' . $component->slug,
                function ($view) use ($component) {

                    $controllerName = $this->camelCase(
                        $this->cleanViewName($component->slug)
                    );
                    
                    
                    $viewData = $this->accessProtected($view, 'data');
                    $this->handleTypingsErrors($viewData, $component->argsTypes, $component->slug);

                    // Get controller data
                    $controllerArgs = (array) $this->getControllerArgs(
                        array_merge((array) $component->args, (array) $viewData),
                        $controllerName
                    );

                    $view->with($controllerArgs);
                }
            );
        } catch (\Throwable $e) {
            echo  '<pre>' . var_dump($e) . '<pre>';
        }
    }

    /**
     * Handle typing errors for the given view data and arguments types.
     *
     * @param array|object $viewData The view data to check for typing errors.
     * @param array|object|false $argsTypes The expected argument types for each key in the view data.
     * @param string $componentSlug The slug of the component being checked.
     * @return void
     */
    public function handleTypingsErrors($viewData, $argsTypes, $componentSlug) {

        if ($this->shouldHideTypingsErrors()) {
            return;
        }

        if (empty((array) $argsTypes) || (empty($viewData) && !is_array($viewData))) { 
            return; 
        }

        foreach ($viewData as $key => $value) {
            if (is_object($argsTypes) && isset($argsTypes->{$key})) {
                $types = explode('|', $argsTypes->{$key});
                $valueType = gettype($value);
        
                // Check if the value is an object, and get its class name without the namespace
                if ($valueType === 'object') {
                    $classNameWithoutNamespace = class_basename($value);
                }
        
                if (!in_array($valueType, $types) && !$valueType === 'NULL') {
                    // Modify the error message to show object class name without namespace if applicable
                    $valueTypeDisplay = $valueType === 'object' ? $classNameWithoutNamespace : $valueType;
                    $this->triggerError(
                        'The parameter <b>"' . $key . '"</b> in the <b>' . $componentSlug . '</b> component should be of type <b>"' 
                        . $argsTypes->{$key} . '"</b> but was received as type <b>"' . $valueTypeDisplay . '"</b>.'
                    );
                }
            } elseif (!in_array($key, ['__laravel_slots', 'slot', 'id', 'classList', 'context', 'attributeList'])) {
                $this->triggerError(
                    'The parameter <b>"' . $key . '"</b> is not recognized in the component <b>"' . $componentSlug . '"</b>'
                );
            }
        }
    }

    /**
     * Determines whether typing errors should be hidden.
     *
     * @return bool Returns true if typing errors should be hidden, false otherwise.
     */
    private function shouldHideTypingsErrors() 
    {
        return (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'production') || defined('WP_CLI');
    }

    /**
     * Triggers a user warning error with the specified message.
     *
     * @param string $message The error message.
     * @return void
     */
    private function triggerError($message = "") {
        trigger_error($message, E_USER_WARNING);
    }

    /**
     * Proxy for accessing provate props
     *
     * @return string Array of values
     */
    public function accessProtected($obj, $prop)
    {
        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }

    /**
     * Get data from controller
     *
     * @return string Array of controller data
     */
    public function getControllerArgs($data, $controllerName): array
    {
        //Run controller & fetch data
        if ($controllerLocation = $this->locateController(ucfirst($controllerName))) {
            $controllerId = md5($controllerLocation);

            if (in_array($controllerId, $this->controllers)) {
                $controller = $this->controllers[$controllerId];
            } else {
                $controller = (string) ("\\" . $this->getNamespace($controllerLocation) . "\\" . $controllerName);
                $controller = new $controller($data, $this->componentCache);
            }

            return $controller->getData();
        }

        return array();
    }

    /**
     * Creates a camelcased string from hypen based string
     *
     * @return string The expected controller name
     */
    public function camelCase($viewName): string
    {
        return (string)str_replace(
            " ",
            "",
            ucwords(
                str_replace('-', ' ', $viewName)
            )
        );
    }

    /**
     * Locates a controller
     *
     * @return string Controller path
     */
    public function locateController($controller)
    {
        if (is_array($this->controllerPaths) && !empty($this->controllerPaths)) {
            foreach ($this->controllerPaths as $path) {
                $file = $path . DIRECTORY_SEPARATOR . $controller . DIRECTORY_SEPARATOR . $controller . '.php';
                if (!$this->cachedFileExists($file)) {
                    continue;
                }
                return $file;
            }
        }

        return false;
    }

    /**
     * Get a class's namespace
     *
     * @param  string $classPath Path to the class php file
     *
     * @return string            Namespace or null
     */
    public function getNamespace($classPath)
    {
        $src = $this->cachedFileGetContents($classPath);
        if (preg_match('/namespace\s+(.+?);/', $src, $m)) {
            return $m[1];
        }
        return null;
    }

    /**
     * Remove .blade.php from view name
     *
     * @return string Simple view name without appended filetype
     */
    public function cleanViewName($viewName): string
    {
        return (string) str_replace('.blade.php', '', $viewName);
    }

    /**
     * Get the file path for the configuration file.
     *
     * This function constructs the path to the configuration file based on the provided directory path.
     * The configuration file is expected to be named after the directory with a '.json' extension.
     *
     * @param string $path The directory path to generate the configuration file path from.
     * @return string The complete path to the configuration file.
     * @throws \Exception If no configuration file is found in the specified path.
     */
    private function getConfigFilePath($path) {
        $configFile = $path . DIRECTORY_SEPARATOR . lcfirst(basename($path)) .".json"; 
        if($this->cachedFileExists($configFile)) {
            return $configFile; 
        }

        throw new \Exception("No config file found in " . $path);
    }

    /**
     * Read and parse a configuration file.
     *
     * This function reads a configuration file from the specified path and parses it as JSON.
     * It also provides caching for the parsed JSON data.
     *
     * @param string $path The path to the configuration file.
     * @return array|false An array representing the parsed JSON data if successful, or false if parsing fails.
     * @throws \Exception If the configuration file is unreadable or contains invalid JSON.
     */
    private function readConfigFile(string $path) {
        $id = md5($path);

        //Fetch cached value
        if(isset(self::$cache['configJson'][$id])) {
            return self::$cache['configJson'][$id]; 
        }

        //Read config
        if (!$json = $this->cachedFileGetContents($path)) {
            throw new \Exception("Configuration file unreadable at " . $path);
        }

        //Check if valid json & return
        if($this->validateJson($json, $path)) {
            return self::$cache['configJson'][$id] = (array) json_decode($json); //Return & store in cache.
        }
        
        return false;
    }

    /**
     * Validate the format of a JSON string.
     *
     * This function validates the format of a JSON string by attempting to parse it as JSON.
     * It utilizes the built-in `json_validate` function in PHP 8.3 and later, or falls back to
     * decoding the JSON string and checking if the decoding was successful in earlier PHP versions.
     *
     * @param string $json The JSON string to validate.
     * @param string $path The path to the JSON file (used for error reporting).
     * @return bool Returns true if the JSON string is valid, false otherwise.
     * @throws \Exception If the JSON string is not valid according to its format.
     */
    private function validateJson(string $json, string $path) {
        if(function_exists('json_validate')) {
            $validJson = json_validate($json); //Introduced in PHP 8.3
        } else {
            $validJson = (bool) json_decode($json, true); //Before PHP 8.3
        }

        if(!$validJson) {
            throw new \Exception("Invalid formatting of configuration file in " . $path);
        }

        return true;
    }
    
    /**
     * Check if a file exists using cached results.
     *
     * This function checks for the existence of a file using cached results to improve performance.
     * It first looks in the cache for a previous check result and returns true if the file is found.
     * If not found in the cache, it checks the file system, updates the cache if found, and returns the result.
     *
     * @param string $path The path to the file to check.
     * @return bool Returns true if the file exists, false otherwise.
     */
    private function cachedFileExists($path) {
        $id = md5($path);
        if(isset(self::$cache['fileExists'][$id])) {
            return true; 
        }

        if(file_exists($path)) {
            self::$cache['fileExists'][$id] = true; 
            return true;
        }

        return false;
    }

    /**
     * Check if a file exists using cached results.
     *
     * This function checks for the existence of a file using cached results to improve performance.
     * It first looks in the cache for a previous check result and returns true if the file is found.
     * If not found in the cache, it checks the file system, updates the cache if found, and returns the result.
     *
     * @param string $path The path to the file to check.
     * @return bool Returns true if the file exists, false otherwise.
     */
    private function cachedFileGetContents($path) {
        $id = md5($path);
    
        if (isset(self::$cache['fileGetContents'][$id])) {
            // If the content is already in the static cache, return it.
            return self::$cache['fileGetContents'][$id];
        }
    
        if (function_exists('wp_cache_get')) {
            // If the wp_cache_get function exists (i.e., running inside WordPress),
            // attempt to retrieve the content from the cache.
            $cachedContent = wp_cache_get($id, 'fileGetContents');
            if ($cachedContent !== false) {
                // Cache the content in the static variable for future use.
                self::$cache['fileGetContents'][$id] = $cachedContent;
                return $cachedContent;
            }
        }
    
        // If not in cache, use file_get_contents
        $content = file_get_contents($path);
    
        if (function_exists('wp_cache_set')) {
            // If the wp_cache_set function exists (i.e., running inside WordPress),
            // cache the content using WordPress's cache.
            wp_cache_set($id, $content, 'fileGetContents');
        }
    
        // Cache the content in the static variable for future use.
        self::$cache['fileGetContents'][$id] = $content;
    
        return $content !== false ? $content : false;
    }
    
    

    /**
     * Check if a file exists using cached results.
     *
     * This function checks for the existence of a file using cached results to improve performance.
     * It first looks in the cache for a previous check result and returns true if the file is found.
     * If not found in the cache, it checks the file system, updates the cache if found, and returns the result.
     *
     * @param string $path The path to the file to check.
     * @return bool Returns true if the file exists, false otherwise.
     */
    private function cachedGlob($path) {
        $id = md5($path);
        if(isset(self::$cache['glob'][$id])) {
            return self::$cache['glob'][$id];
        }

        if($list = glob($path, GLOB_ONLYDIR)) {
            return self::$cache['glob'][$id] = $list; 
        }

        return false;
    }

}
