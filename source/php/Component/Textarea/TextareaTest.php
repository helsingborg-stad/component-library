<?php

namespace ComponentLibrary\Component\Textarea;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use PHPUnit\Framework\TestCase;

class TextareaTest extends TestCase
{
    /**
     * @testdox component is deprecated
     */
    public function testComponentIsDeprecated()
    {
        try {
            new Textarea(['required' => false], $this->createMock(CacheInterface::class), $this->createMock(TagSanitizerInterface::class));
        } catch (\Throwable $e) {
            $this->assertSame(E_USER_DEPRECATED, $e->getCode(), 'Expected a deprecation notice to be triggered.');
            return;
        }

        $this->assertTrue(false, 'Expected deprecation notice was not triggered.');
    }
}
