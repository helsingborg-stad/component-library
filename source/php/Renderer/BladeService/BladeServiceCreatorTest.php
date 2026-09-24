<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeService;

use HelsingborgStad\BladeService\BladeServiceInterface;
use PHPUnit\Framework\TestCase;

class BladeServiceCreatorTest extends TestCase
{
    /**
     * @testdox it creates a BladeServiceInterface instance
     */
    public function testCreatesBladeServiceInterface(): void
    {
        $bladeService = (new BladeServiceCreator())->create([__DIR__]);

        static::assertInstanceOf(BladeServiceInterface::class, $bladeService);
    }

    /**
     * @testdox it restores error reporting after creating the Blade service
     */
    public function testRestoresErrorReporting(): void
    {
        $originalErrorReporting = error_reporting();
        error_reporting(E_ALL);

        try {
            (new BladeServiceCreator())->create([__DIR__]);

            static::assertSame(E_ALL, error_reporting());
        } finally {
            error_reporting($originalErrorReporting);
        }
    }
}