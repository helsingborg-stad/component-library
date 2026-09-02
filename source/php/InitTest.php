<?php

declare(strict_types=1);

namespace ComponentLibrary;

use PHPUnit\Framework\TestCase;

class InitTest extends TestCase
{
    protected function setUp(): void
    {
        Init::clearBladeServiceCache();
    }

    protected function tearDown(): void
    {
        Init::clearBladeServiceCache();
    }

    public function testReusesBladeServiceForIdenticalPathConfiguration(): void
    {
        $first = (new Init([]))->getEngine();
        $second = (new Init([]))->getEngine();

        static::assertSame($first, $second);
    }

    public function testDoesNotReuseBladeServiceForDifferentPathConfiguration(): void
    {
        $default = (new Init([]))->getEngine();
        $withExternalPath = (new Init([__DIR__]))->getEngine();

        static::assertNotSame($default, $withExternalPath);
    }

    public function testCacheCanBeCleared(): void
    {
        $first = (new Init([]))->getEngine();

        Init::clearBladeServiceCache();

        static::assertNotSame($first, (new Init([]))->getEngine());
    }
}
