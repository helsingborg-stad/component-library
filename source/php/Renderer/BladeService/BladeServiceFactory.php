<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeService;

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Cache\TrySetWpCache;
use ComponentLibrary\Helper\TagSanitizer;
use ComponentLibrary\Renderer\NullWpService;
use HelsingborgStad\BladeService\BladeService;
use HelsingborgStad\BladeService\BladeServiceInterface;
use WpService\Contracts\ApplyFilters;
use WpService\Contracts\WpCacheGet;
use WpService\Contracts\WpCacheSet;

class BladeServiceFactory
{
    public function __construct(
        private ApplyFilters&WpCacheGet&WpCacheSet $wpService = new NullWpService(),
    ) {}

    public function create(array $externalViewPaths): BladeServiceInterface
    {
        $viewPaths = $this->getSanitizedDirectoryPathsInternal($externalViewPaths, 'ComponentLibrary/ViewPaths');
        if (count($viewPaths) === 0) {
            throw new \Exception('No valid view paths were configured. Please ensure at least one valid directory path is provided.');
        }
        $bladeService = new BladeService($viewPaths);
        $register = new Register\Register(
            $bladeService,
            new TrySetWpCache(new StaticCache()),
            new TagSanitizer(),
            $this->wpService,
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

    /**
     * Returns sanitized paths with trailing directory separator.
     *
     * @param array $externalPaths
     * @param string $filter
     * @return array
     */
    private function getSanitizedPathsInternal(array $externalPaths, string $filter): array
    {
        return $this->getSanitizedPathsWithMapper(
            $externalPaths,
            $filter,
            static function ($path) {
                $directory = rtrim($path, DIRECTORY_SEPARATOR);
                return $directory . DIRECTORY_SEPARATOR;
            },
        );
    }

    /**
     * Returns sanitized directory paths, ensuring they are directories or have a trailing separator.
     *
     * @param array $externalPaths
     * @param string $filter
     * @return array
     */
    private function getSanitizedDirectoryPathsInternal(array $externalPaths, string $filter): array
    {
        return $this->getSanitizedPathsWithMapper(
            $externalPaths,
            $filter,
            static function ($path) {
                $directory = rtrim($path, DIRECTORY_SEPARATOR);
                return is_dir($directory) ? $directory : $directory . DIRECTORY_SEPARATOR;
            },
        );
    }

    /**
     * Shared logic for sanitizing and filtering paths with a custom mapping function.
     *
     * @param array $externalPaths
     * @param string $filter
     * @param callable $mapper
     * @return array
     */
    private function getSanitizedPathsWithMapper(array $externalPaths, string $filter, callable $mapper): array
    {
        $paths = array_unique(array_merge($this->getInternalPaths(), $externalPaths));
        $filteredPaths = $this->wpService->applyFilters($filter, $paths);
        if (!is_array($filteredPaths)) {
            $filteredPaths = [];
        }
        return array_map($mapper, $filteredPaths);
    }

    public function getInternalPaths(): array
    {
        return [__DIR__ . '/../../Component' . DIRECTORY_SEPARATOR];
    }
}
