<?php

declare(strict_types=1);

namespace ComponentLibrary\ComponentConfiguration;

use ComponentLibrary\Component\Accordion\AccordionData;
use ComponentLibrary\Component\Accordion\AccordionItemData;
use ComponentLibrary\Component\Button\ButtonData;
use ComponentLibrary\Component\Card\CardData;
use ComponentLibrary\Component\Card__body\CardBodyData;
use ComponentLibrary\Component\Card__floating\CardFloatingData;
use ComponentLibrary\Component\Card__footer\CardFooterData;
use ComponentLibrary\Component\Card__header\CardHeaderData;
use ComponentLibrary\Component\Card__image\CardImageData;
use ComponentLibrary\Component\Code\CodeData;
use ComponentLibrary\Component\Fab\FabData;
use ComponentLibrary\Component\Link\LinkData;
use ComponentLibrary\Component\Modal\ModalData;
use ComponentLibrary\Component\Notification\NotificationData;
use ComponentLibrary\Component\Paper\PaperData;
use ComponentLibrary\Component\Slider__item\Slider__itemData;
use ComponentLibrary\Component\Typography\TypographyData;
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

    /**
     * @dataProvider componentDataClassesWithSlots
     */
    public function testItReflectsHtmlStringAsTheOnlySlotType(string $dataClass): void
    {
        $types = (new ComponentDataReflector())->getArgumentTypes($dataClass);

        static::assertSame('Illuminate\\Support\\HtmlString|NULL', $types['slot']);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function componentDataClassesWithSlots(): array
    {
        return [
            'card' => [CardData::class],
            'card body' => [CardBodyData::class],
            'card floating' => [CardFloatingData::class],
            'card footer' => [CardFooterData::class],
            'card header' => [CardHeaderData::class],
            'card image' => [CardImageData::class],
            'code' => [CodeData::class],
            'fab' => [FabData::class],
            'link' => [LinkData::class],
            'modal' => [ModalData::class],
            'notification' => [NotificationData::class],
            'paper' => [PaperData::class],
            'slider item' => [Slider__itemData::class],
            'typography' => [TypographyData::class],
        ];
    }
}
