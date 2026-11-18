<?php

use ComponentLibrary\Component\Accordion__item\Accordion__item;
use ComponentLibrary\Component\Accordion__item\AccordionItemData;

class Accordion__itemTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider emptyHeadingProvider
     */
    public function testEmptyHeadingBecomesEmptyArray($heading)
    {
        $this->assertSame([], $this->getInitializedData(['heading' => $heading])['heading']);
    }

    public static function emptyHeadingProvider(): array
    {
        return [
            'empty string' => [''],
            'empty array'  => [[]],
            'null'         => [null],
        ];
    }

    public function testStringHeadingIsWrappedInArray()
    {
        $this->assertSame(['Title'], $this->getInitializedData(['heading' => 'Title'])['heading']);
    }

    public function testArrayHeadingIsKept()
    {
        $this->assertSame(['A', 'B'], $this->getInitializedData(['heading' => ['A', 'B']])['heading']);
    }

    private function getInitializedData(array $data): array
    {
        $default   = (new \ComponentLibrary\ComponentConfiguration\ComponentDataReflector())->getDefaultArguments(AccordionItemData::class);
        $component = new Accordion__item(
            array_merge($default, $data),
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
        $component->init();

        return $component->getData();
    }
}
