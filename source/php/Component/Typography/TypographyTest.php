<?php

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Component\Typography\Typography;
use ComponentLibrary\Helper\TagSanitizer;

class TypographyTest extends PHPUnit\Framework\TestCase
{
    public function testInitRemovesArraySlotBeforeRendering(): void
    {
        $typography = new Typography(
            [
                'element' => 'p',
                'slot' => ['Unexpected content'],
            ],
            new StaticCache(),
            new TagSanitizer(),
        );

        $data = $typography->getData();

        static::assertSame('', $data['slot']);
    }
}