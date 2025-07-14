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

        $this->bladeService = new BladeService($sanitizedViewPaths);
        $this->register = new Register(
            $this->bladeService,
            $this->getCache(),
            new TagSanitizer()
        );
        
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
        foreach ($controllerPaths as $path) {
            $this->register->addControllerPath(
                rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR
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

        foreach ($internalComponentsPath as $path) {
            $this->register->registerInternalComponents(
                rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR
            );
        }
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
