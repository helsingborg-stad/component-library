<?php

namespace ComponentLibrary;

use ComponentLibrary\Component\Config\ComponentConfiguration;
use ComponentLibrary\Component\Config\ComponentConfigurationInterface;
use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use HelsingborgStad\BladeService\BladeServiceInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentSlot;
use Throwable;

class Register
{
    private static array $cache = [
        'config'            => [],
        'fileExists'        => [],
        'fileGetContents'   => [],
        'glob'              => [],
    ]; 

    public ?object $data = null;
    public string $cachePath = ""; 
    public array $viewPaths = [];
    public array $controllerPaths = [];
    private array $reservedNames = ["data", "class", "list", "lang"];
    private array $controllers = [];

    public function __construct(
        private BladeServiceInterface $blade,
        private CacheInterface $componentCache,
        private TagSanitizerInterface $tagSanitizer
    ) {
    }

    /**
     * Add a new component to the system.
     *
     * @param string $slug The unique identifier for the component.
     * @param array $defaultParameters The default arguments for the component.
     * @param string|null $view The optional view name for the component.
     * @throws \Exception if the provided slug is reserved or invalid.
     */
    public function add(string $slug, array $defaultParameters, array $parameterTypes = [], ?string $view = null): void
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
            'slug'       => $slug,
            'args'       => (object) $defaultParameters,
            'view'       => $slug . DIRECTORY_SEPARATOR . $view,
            'controller' => $slug,
            'argsTypes'  => (object) $parameterTypes
        );

        $this->blade->registerComponentDirective( ucfirst($slug) . '.' . $slug, $slug);
        $this->registerViewComposer($this->data->{$slug});
    }

    /**
     * Appends the controller path object
     *
     * @return string The updated object with controller paths
     */
    public function addControllerPath(string $path, bool $prepend = true): array
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
    public function registerInternalComponents(string $path): array
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
                    $config->getSlug(),
                    $config->getDefaultParameters(),
                    $config->getTypes(),
                    $config->getView()
                );

                //Log
                $result[] = $config->getSlug();
            }
        }

        return $result;
    }

    public function getEngine(): BladeServiceInterface
    {
        return $this->blade;
    }

    /**
     * Use defined view or, generate from slug
     * 
     * @return string The view name included filetype
     */
    private function getViewName(string $slug, ?string $view = null): string
    {
        if (is_null($view)) {
            $view = $slug . '.blade.php';
        }
        return $view;
    }

    public function registerViewComposer(object $component): void
    {
        try {
            $this->blade->registerComponent(
                ucfirst($component->slug) . '.' . $component->slug,
                function ($view) use ($component) {

                    $controllerName = $this->camelCase(
                        $this->cleanViewName($component->slug)
                    );
                    
                    
                    $viewData = $this->accessProtected($view, 'data');

                    if (!is_array($viewData) && !is_object($viewData)) {
                        throw new \UnexpectedValueException(
                            'View data must be an array or object, received: ' . gettype($viewData)
                        );
                    }

                    if (is_object($viewData)) {
                        $viewData = get_object_vars($viewData);
                    }
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
            // Log error instead of echoing to prevent output in wrong order
            if (function_exists('error_log')) {
                error_log('ComponentLibrary: Error in registerViewComposer for component "' . $component->slug . '": ' . $e->getMessage());
            }
            // Re-throw to allow proper error handling
            throw $e;
        }
    }

    /**
     * Handle typing errors for the given view data and arguments types.
     *
     * @param array $viewData The view data to check for typing errors.
     * @param array|object $argsTypes The expected argument types for each key in the view data.
     * @param string $componentSlug The slug of the component being checked.
     * @return void
     */
    public function handleTypingsErrors(array $viewData, array|object $argsTypes, string $componentSlug): void
    {

        if ($this->shouldHideTypingsErrors()) {
            return;
        }

        if (is_array($argsTypes) && empty($argsTypes)) { 
            return; 
        }

        foreach ($viewData as $key => $value) {
            $types = $this->resolveArgumentTypes($argsTypes, $key);

            if (!empty($types)) {
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
                        . implode('|', $types) . '"</b> but was received as type <b>"' . $valueTypeDisplay . '"</b>.'
                    );
                }
            } elseif (
                !in_array($key, ['__laravel_slots', 'slot', 'id', 'classList', 'context', 'attributeList', 'baseClass', 'lang', 'isBlock', 'isShortcode']) && 
                !(is_object($value) && $value instanceof ComponentSlot)
            ) {
                $this->triggerError(
                    'The parameter <b>"' . $key . '"</b> is not recognized in the component <b>"' . $componentSlug . '"</b>'
                );
            }
        }
    }

    /**
     * @param array|object $argsTypes
     * @return array<int, string>
     */
    private function resolveArgumentTypes(array|object $argsTypes, string $key): array
    {
        if (is_object($argsTypes) && isset($argsTypes->{$key})) {
            return explode('|', (string) $argsTypes->{$key});
        }

        if (is_array($argsTypes) && isset($argsTypes[$key])) {
            return explode('|', (string) $argsTypes[$key]);
        }

        return [];
    }

    /**
     * Determines whether typing errors should be hidden.
     *
     * @return bool Returns true if typing errors should be hidden, false otherwise.
     */
    private function shouldHideTypingsErrors(): bool 
    {
        return (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'production') || defined('WP_CLI');
    }

    /**
     * Triggers a user warning error with the specified message.
     *
     * @param string $message The error message.
     * @return void
     */
    private function triggerError(string $message = ""): void {
        trigger_error($message, E_USER_WARNING);
    }

    /**
     * Proxy for accessing provate props
     *
     * @return string Array of values
     */
    public function accessProtected(object $obj, string $prop): mixed
    {
        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }

    /**
     * Get data from controller
     *
     * @return array<int|string, mixed> Array of controller data
     */
    public function getControllerArgs(array $data, string $controllerName): array
    {
        //Run controller & fetch data
        if ($controllerLocation = $this->locateController(ucfirst($controllerName))) {
            $controllerClass = (string) ("\\" . $this->getNamespace($controllerLocation) . "\\" . $controllerName);
            $controller = new $controllerClass($data, $this->componentCache, $this->tagSanitizer);
            
            return $controller->getData();
        }

        return array();
    }

    /**
     * Creates a camelcased string from hypen based string
     *
     * @return string The expected controller name
     */
    public function camelCase(string $viewName): string
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
    public function locateController(string $controller): string|false
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
    public function getNamespace(string $classPath): ?string
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
    public function cleanViewName(string $viewName): string
    {
        return (string) str_replace('.blade.php', '', $viewName);
    }

    /**
     * Get the file path for the configuration file.
     *
     * This function constructs the path to the configuration file based on the provided directory path.
     * The configuration file is expected to be named after the directory with a 'Config.php' suffix.
     *
     * @param string $path The directory path to generate the configuration file path from.
     * @return string The complete path to the configuration file.
     * @throws \Exception If no configuration file is found in the specified path.
     */
    private function getConfigFilePath(string $path): string {
        $configFile = $path . DIRECTORY_SEPARATOR . lcfirst(basename($path)) . "Config.php";
        if($this->cachedFileExists($configFile)) {
            return $configFile;
        }

        throw new \Exception("No config file found in " . $path);
    }

    /**
     * Read and parse a configuration file.
     *
     * This function requires a PHP configuration file that must return an array or configuration instance.
     * Results are cached in a static array to avoid redundant file loads.
     * Plain array configurations are automatically wrapped into ComponentConfiguration singleton instances.
     *
     * @param string $path The path to the configuration file.
     * @return ComponentConfigurationInterface The configuration object returned by the file.
     * @throws \Exception If the configuration file is missing or does not return an array.
     */
    private function readConfigFile(string $path): ComponentConfigurationInterface {
        $id = md5($path);

        if (isset(self::$cache['config'][$id])) {
            return self::$cache['config'][$id];
        }

        if (!$this->cachedFileExists($path)) {
            throw new \Exception("Configuration file unreadable at " . $path);
        }

        $config = require $path;

        if ($config instanceof ComponentConfigurationInterface) {
            $configInstance = $config;
        } elseif (is_array($config)) {
            $configInstance = ComponentConfiguration::getInstance($config);
        } else {
            $receivedType = is_object($config) ? get_class($config) : gettype($config);
            throw new \Exception(
                "Configuration file must return an array or an implementation of ComponentLibrary\\Component\\Config\\ComponentConfigurationInterface at " . $path . ', received: ' . $receivedType
            );
        }

        return self::$cache['config'][$id] = $configInstance;
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
    private function cachedFileExists(string $path): bool {
        $id = md5($path);
        
        // Check static cache first
        if(isset(self::$cache['fileExists'][$id])) {
            return true; 
        }

        // Check file system
        if(file_exists($path)) {
            // Use atomic write to prevent race condition
            self::$cache['fileExists'][$id] = true; 
            return true;
        }

        return false;
    }

    /**
     * Get file contents using cached results.
     *
     * This function retrieves file contents using cached results to improve performance.
     * It first looks in the cache for a previous result and returns it if found.
     * If not found in the cache, it reads the file, updates the cache, and returns the result.
     *
     * @param string $path The path to the file to read.
     * @return string|false Returns the file contents if successful, false otherwise.
     */
    private function cachedFileGetContents(string $path): string|false {
        $id = md5($path);
    
        // Check static cache first
        if (isset(self::$cache['fileGetContents'][$id])) {
            return self::$cache['fileGetContents'][$id];
        }
    
        // Check WordPress cache if available
        if (function_exists('wp_cache_get')) {
            $cachedContent = wp_cache_get($id, 'fileGetContents');
            if ($cachedContent !== false) {
                // Cache the content in the static variable for future use.
                self::$cache['fileGetContents'][$id] = $cachedContent;
                return $cachedContent;
            }
        }
    
        // Read from file system
        $content = file_get_contents($path);
        
        // Return false if file_get_contents failed
        if ($content === false) {
            return false;
        }
    
        // Cache in WordPress cache if available
        if (function_exists('wp_cache_set')) {
            wp_cache_set($id, $content, 'fileGetContents');
        }
    
        // Cache the content in the static variable for future use.
        self::$cache['fileGetContents'][$id] = $content;
    
        return $content;
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
    private function cachedGlob(string $path): array|false {
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
