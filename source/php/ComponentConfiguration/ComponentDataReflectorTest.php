<?php

declare(strict_types=1);

namespace ComponentLibrary\ComponentConfiguration;

use ComponentLibrary\Component\Accordion\AccordionData;
use ComponentLibrary\Component\Accordion\AccordionItemData;
use ComponentLibrary\Component\Button\ButtonData;
use PHPUnit\Framework\TestCase;

final class GenericCollectionDataFixture
{
    /**
     * @param array<int, AccordionItemData> $list
     */
    public function __construct(
        public array $list = [],
    ) {}
}

class ComponentDataReflectorTest extends TestCase
{
    public function testItReflectsDefaultValuesAndNullableTypes(): void
    {
        $reflector = new ComponentDataReflector();

        $definitions = $reflector->getPropertyDefinitions(ButtonData::class);

        static::assertSame('string|NULL', $definitions['href']['type']);
        static::assertNull($definitions['href']['default']);
        static::assertFalse($definitions['href']['required']);
        static::assertSame('boolean', $definitions['toggle']['type']);
        static::assertFalse($definitions['toggle']['default']);
    }

    public function testItReflectsRequiredProperties(): void
    {
        $reflector = new ComponentDataReflector();

        $definitions = $reflector->getPropertyDefinitions(AccordionItemData::class);

        static::assertTrue($definitions['heading']['required']);
        static::assertFalse($definitions['heading']['hasDefault']);
        static::assertTrue($definitions['content']['required']);
        static::assertFalse($definitions['content']['hasDefault']);
    }

    public function testItReflectsUnionAndCollectionMetadata(): void
    {
        $reflector = new ComponentDataReflector();

        $definitions = $reflector->getPropertyDefinitions(AccordionData::class);

        static::assertSame('string|array', $definitions['heading']['type']);
        static::assertSame('AccordionItemData', $definitions['list']['collectionType']);
        static::assertSame([], $definitions['list']['default']);
    }

    public function testItReflectsGenericCollectionMetadata(): void
    {
        $reflector = new ComponentDataReflector();

        $definitions = $reflector->getPropertyDefinitions(GenericCollectionDataFixture::class);

        static::assertSame('AccordionItemData', $definitions['list']['collectionType']);
    }
}
