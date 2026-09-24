<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeService;

use ComponentLibrary\Renderer\VendorDeprecationSilencer;
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
        return (new VendorDeprecationSilencer())->run(
            static function () use ($viewPaths): BladeServiceInterface {
            return new BladeService($viewPaths);
            },
        );
    }
}