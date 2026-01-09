<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeService;

use HelsingborgStad\BladeService\BladeServiceInterface;
use PHPUnit\Framework\TestCase;

class BladeServiceFactoryTest extends TestCase
{
    /**
     * @testdox it should create a BladeServiceInterface instance with valid paths
     */
    public function testCreateBladeServiceInterface()
    {
        $externalPaths = [__DIR__];
        $factory = new BladeServiceFactory();
        $bladeService = $factory->create($externalPaths);
        static::assertInstanceOf(BladeServiceInterface::class, $bladeService);
    }

    /**
     * @testdox getInternalPaths() should return valid directory paths
     */
    public function testInternalPathsConstant()
    {
        $factory = new BladeServiceFactory();

        foreach ($factory->getInternalPaths() as $path) {
            static::assertDirectoryExists($path);
        }
    }
}
