<?php

declare(strict_types=1);

namespace ComponentLibrary;

use ComponentLibrary\Assets\PhpAssetEnqueuer;
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

    public function testExplicitEnqueuerDoesNotCreateIncompleteDefaultCacheEntry(): void
    {
        $customEnqueuer = new PhpAssetEnqueuer();
        $custom = new Init([], $customEnqueuer);
        $default = new Init([]);

        static::assertSame($customEnqueuer, $custom->getAssetEnqueuer());
        static::assertNotSame($custom->getEngine(), $default->getEngine());
        static::assertNotSame($customEnqueuer, $default->getAssetEnqueuer());
    }

    public function testExplicitEnqueuerDoesNotReplaceExistingDefaultCacheEntry(): void
    {
        $default = new Init([]);
        $custom = new Init([], new PhpAssetEnqueuer());
        $reusedDefault = new Init([]);

        static::assertNotSame($default->getEngine(), $custom->getEngine());
        static::assertSame($default->getEngine(), $reusedDefault->getEngine());
        static::assertSame($default->getAssetEnqueuer(), $reusedDefault->getAssetEnqueuer());
    }
}
