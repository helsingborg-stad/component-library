<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeService;

use HelsingborgStad\BladeService\BladeService;
use HelsingborgStad\BladeService\BladeServiceInterface;

class BladeServiceCreator
{
    /**
     * Creates a Blade service while suppressing PHP 8.4 deprecations emitted by legacy Illuminate signatures.
     *
     * @param array $viewPaths
     * @return BladeServiceInterface
     */
    public function create(array $viewPaths): BladeServiceInterface
    {
        $errorReporting = error_reporting();
        error_reporting($errorReporting & ~E_DEPRECATED);

        try {
            return new BladeService($viewPaths);
        } finally {
            error_reporting($errorReporting);
        }
    }
}