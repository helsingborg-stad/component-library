<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeEngine;

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Cache\TrySetWpCache;
use ComponentLibrary\Helper\TagSanitizer;
use ComponentLibrary\Register;
use HelsingborgStad\BladeService\BladeService;
use HelsingborgStad\BladeService\BladeServiceInterface;
use WpService\Contracts\ApplyFilters;

class BladeServiceFactory
{
    private ApplyFilters $wpService;

    public function __construct(ApplyFilters $wpService = new NullWpService())
    {
        $this->wpService = $wpService;
    }

    public function create(array $externalViewPaths): BladeServiceInterface
    {
        $viewPaths = $this->getSanitizedDirectoryPathsInternal($externalViewPaths, 'ComponentLibrary/ViewPaths');
        if (count($viewPaths) === 0) {
            throw new \Exception('View paths not defined.');
        }
        $bladeService = new BladeService($viewPaths);
        $register = new Register(
            $bladeService,
            new TrySetWpCache(new StaticCache()),
            new TagSanitizer(),
        );
        // Register controller paths
        foreach ($this->getSanitizedPathsInternal([], 'helsingborg-stad/blade/controllerPaths') as $path) {
            $register->addControllerPath($path);
        }
        // Register internal component paths
        foreach ($this->getSanitizedPathsInternal([], 'helsingborg-stad/blade/internalComponentsPath') as $path) {
            $register->registerInternalComponents($path);
        }
        return $bladeService;
    }

    private function getSanitizedPathsInternal(array $externalPaths, string $filter): array
    {
        $paths = array_unique(array_merge($this->getInternalPaths(), $externalPaths));
        $filteredPaths = $this->wpService->applyFilters($filter, $paths);
        if (!is_array($filteredPaths)) {
            $filteredPaths = [];
        }
        return array_map(static function ($path) {
            $directory = rtrim($path, DIRECTORY_SEPARATOR);
            return $directory . DIRECTORY_SEPARATOR;
        }, $filteredPaths);
    }

    private function getSanitizedDirectoryPathsInternal(array $externalPaths, string $filter): array
    {
        $paths = array_unique(array_merge($this->getInternalPaths(), $externalPaths));
        $filteredPaths = $this->wpService->applyFilters($filter, $paths);
        if (!is_array($filteredPaths)) {
            $filteredPaths = [];
        }
        return array_map(static function ($path) {
            $directory = rtrim($path, DIRECTORY_SEPARATOR);
            return is_dir($directory) ? $directory : $directory . DIRECTORY_SEPARATOR;
        }, $filteredPaths);
    }

    public function getInternalPaths(): array
    {
        return [__DIR__ . '/../../Component' . DIRECTORY_SEPARATOR];
    }
}
