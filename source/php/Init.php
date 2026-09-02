<?php

namespace ComponentLibrary;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Cache\TrySetWpCache;
use ComponentLibrary\Helper\TagSanitizer;
use ComponentLibrary\Register;
use HelsingborgStad\BladeService\BladeService;
use HelsingborgStad\BladeService\BladeServiceInterface;

class Init {

    /**
     * Blade services are expensive to construct because every component directive
     * and view composer is registered on each instance. Keep one instance per
     * effective path configuration for the lifetime of the current PHP request.
     *
     * @var array<string, BladeServiceInterface>
     */
    private static array $bladeServiceCache = [];

    private $register = null;
    private BladeServiceInterface $bladeService;
    
    public function __construct($externalViewPaths) {
        $paths = array(
            'viewPaths' => array(),
            'controllerPaths' => array(),
            'internalComponentsPath' => array(),
        );
        // Add view path to renderer
        // In this case all components, their controller and view path are located under the same folder structure.
        // This may differ in a Wordpress child implementation.
        $internalPaths = array( __DIR__ . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR );

        // Initialize all view paths so that this library is last
        $viewPaths = array_unique(
            array_merge($paths['viewPaths'], $internalPaths)
        );

        $viewPaths = array_merge($viewPaths, $externalViewPaths);
        
        if (function_exists('apply_filters')) {
            $viewPaths = apply_filters(
                'ComponentLibrary/ViewPaths',
                $viewPaths
            );
        }
        
        if(!is_array($viewPaths) || empty($viewPaths)) {  
            throw new \Exception("View paths not defined.");
        } 
        
        $sanitizedViewPaths = array();
        foreach ($viewPaths as $path) {
            $directory = rtrim($path, DIRECTORY_SEPARATOR); 
            if(is_dir($directory)) {
                $sanitizedViewPaths[] = $directory;
            }
        }

        // Initialize all controller paths so that this library is last
        $controllerPaths = array_unique(
            array_merge($paths['controllerPaths'], $internalPaths)
        );
        if (function_exists('apply_filters')) {
            $controllerPaths = apply_filters(
                'helsingborg-stad/blade/controllerPaths',
                $controllerPaths
            );
        }
        
        // Initialize all internal components paths so that this library is last
        $internalComponentsPath = array_unique(
            array_merge($paths['internalComponentsPath'], $internalPaths)
        );
        if (function_exists('apply_filters')) {
            $internalComponentsPath = apply_filters(
                'helsingborg-stad/blade/internalComponentsPath',
                $internalComponentsPath
            );
        }

        $cacheKey = hash('sha256', serialize([
            $sanitizedViewPaths,
            $controllerPaths,
            $internalComponentsPath,
        ]));

        if (isset(self::$bladeServiceCache[$cacheKey])) {
            $this->bladeService = self::$bladeServiceCache[$cacheKey];
            return;
        }

        $this->bladeService = new BladeService($sanitizedViewPaths);
        $this->register = new Register(
            $this->bladeService,
            $this->getCache(),
            new TagSanitizer()
        );

        foreach ($controllerPaths as $path) {
            $this->register->addControllerPath(
                rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR
            );
        }

        foreach ($internalComponentsPath as $path) {
            $this->register->registerInternalComponents(
                rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR
            );
        }

        self::$bladeServiceCache[$cacheKey] = $this->bladeService;
    }

    /**
     * Clear the in-process cache. Primarily useful for long-running workers and tests.
     */
    public static function clearBladeServiceCache(): void
    {
        self::$bladeServiceCache = [];
    }

    private function getCache(): CacheInterface
    {
        return new TrySetWpCache(new StaticCache());
    }

    public function getEngine():BladeServiceInterface
    {
        return $this->bladeService;
    }
}
