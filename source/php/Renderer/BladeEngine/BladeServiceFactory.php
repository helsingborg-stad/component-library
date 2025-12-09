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
    public function __construct(
        private ApplyFilters $wpService = new NullWpService(),
    ) {}

    public function create(array $externalViewPaths): BladeServiceInterface
    {
        $viewPaths = $this->mergeAndSanitizePaths([], $externalViewPaths, 'ComponentLibrary/ViewPaths');

        if (count($viewPaths) === 0) {
            throw new \Exception('View paths not defined.');
        }

        $bladeService = new BladeService($viewPaths);
        $register = new Register($bladeService, new TrySetWpCache(new StaticCache()), new TagSanitizer());

        $controllerPaths = $this->mergeAndSanitizePaths([], [], 'helsingborg-stad/blade/controllerPaths', false);
        foreach ($controllerPaths as $path) {
            $register->addControllerPath($path);
        }

        $internalComponentsPaths = $this->mergeAndSanitizePaths([], [], 'helsingborg-stad/blade/internalComponentsPath', false);
        foreach ($internalComponentsPaths as $path) {
            $register->registerInternalComponents($path);
        }

        return $bladeService;
    }

    /**
     * Merge, apply filters, and sanitize directory paths.
     */
    private function mergeAndSanitizePaths(array $basePaths, array $externalPaths, string $filter, bool $checkIsDir = true): array
    {
        $paths = array_unique(array_merge($basePaths, $this->getInternalPaths(), $externalPaths));
        $paths = $this->wpService->applyFilters($filter, $paths);
        if (!is_array($paths)) {
            return [];
        }
        $sanitized = [];
        foreach ($paths as $path) {
            $directory = rtrim($path, DIRECTORY_SEPARATOR);
            if ($checkIsDir && is_dir($directory)) {
                $sanitized[] = $directory;
                continue;
            }

            $sanitized[] = $directory . DIRECTORY_SEPARATOR;
        }

        return $sanitized;
    }

    public function getInternalPaths(): array
    {
        return [__DIR__ . '/../../Component' . DIRECTORY_SEPARATOR];
        ;
    }
}
