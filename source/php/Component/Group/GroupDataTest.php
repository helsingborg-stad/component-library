<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Group;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use ComponentLibrary\Helper\TagSanitizerInterface;
use PHPUnit\Framework\TestCase;

class GroupDataTest extends TestCase
{
    public function testTypedConfigDescribesTheGroupContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(GroupData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('group', $config->slug);
        static::assertSame(GroupData::class, $config->data);
        static::assertSame('horizontal', $defaults['direction']);
        static::assertArrayHasKey('justifyContent', $defaults);
        static::assertArrayHasKey('jusitifyContent', $defaults);
    }

    public function testLegacyJusitifyContentInputIsStillSupported(): void
    {
        $data = array_merge(
            new ComponentDataReflector()->getDefaultArguments(GroupData::class),
            ['jusitifyContent' => 'center'],
        );

        $group = new Group(
            $data,
            new class implements CacheInterface {
                public function get(string $key, ?string $group = null): mixed
                {
                    return null;
                }

                public function set(string $key, mixed $data, ?string $group = null): void {}
            },
            new class implements TagSanitizerInterface {
                public function removeATags(string $string): string
                {
                    return strip_tags($string, '<a>');
                }
            },
        );

        static::assertContains('c-group--justify-content-center', $group->getData()['classList']);
    }

    public function testCorrectedJustifyContentInputIsStillSupported(): void
    {
        $data = array_merge(
            new ComponentDataReflector()->getDefaultArguments(GroupData::class),
            ['justifyContent' => 'center'],
        );

        $group = new Group(
            $data,
            new class implements CacheInterface {
                public function get(string $key, ?string $group = null): mixed
                {
                    return null;
                }

                public function set(string $key, mixed $data, ?string $group = null): void {}
            },
            new class implements TagSanitizerInterface {
                public function removeATags(string $string): string
                {
                    return strip_tags($string, '<a>');
                }
            },
        );

        static::assertContains('c-group--justify-content-center', $group->getData()['classList']);
    }
}
