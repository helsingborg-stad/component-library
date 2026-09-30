<?php

declare(strict_types=1);

namespace ComponentLibrary\Component\Icon;

use ComponentLibrary\ComponentConfiguration\ComponentConfig;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Helper\TagSanitizer;
use PHPUnit\Framework\TestCase;

class IconDataTest extends TestCase
{
    public function testTypedConfigDescribesTheIconContract(): void
    {
        $reflector = new ComponentDataReflector();
        $config = require __DIR__ . '/config.php';
        $defaults = $reflector->getDefaultArguments(IconData::class);
        $types = $reflector->getArgumentTypes(IconData::class);

        static::assertInstanceOf(ComponentConfig::class, $config);
        static::assertSame('icon', $config->slug);
        static::assertSame(IconData::class, $config->data);
        static::assertNull($defaults['filled']);
        static::assertSame('boolean|NULL', $types['filled']);
        static::assertSame('outlined', $defaults['variant']);
        static::assertSame(400, $defaults['weight']);
    }

    public function testMaterialSvgVariantsAndWeights(): void
    {
        $defaults = (new ComponentDataReflector())->getDefaultArguments(IconData::class);
        foreach (['outlined', 'rounded', 'sharp'] as $variant) {
            foreach ([200, 400, 600] as $weight) {
                $icon = new Icon(
                    array_merge($defaults, ['icon' => 'home', 'variant' => $variant, 'weight' => $weight]),
                    new StaticCache(),
                    new TagSanitizer(),
                );
                $data = $icon->getData();
                static::assertStringContainsString('<svg', $data['svgElementFromFile']);
                static::assertStringContainsString('viewBox=', $data['svgElementFromFile']);
                static::assertStringNotContainsString('data-material-symbol', $data['attribute']);
            }
        }
    }
}
