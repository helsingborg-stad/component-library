<?php

namespace ComponentLibrary\Component\AnchorMenu;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use PHPUnit\Framework\TestCase;

class AnchorMenuTest extends TestCase
{
    /**
     * @testdox component is deprecated
     */
    public function testComponentIsDeprecated()
    {
        try {
            new AnchorMenu([], $this->createMock(CacheInterface::class), $this->createMock(TagSanitizerInterface::class));
        } catch (\Throwable $e) {
            $this->assertSame(E_USER_DEPRECATED, $e->getCode(), 'Expected a deprecation notice to be triggered.');
            return;
        }

        $this->assertTrue(false, 'Expected deprecation notice was not triggered.');
    }
}
