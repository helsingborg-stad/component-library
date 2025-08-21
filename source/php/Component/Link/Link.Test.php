<?php

namespace ComponentLibrary\Component\Link;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LinkTest extends TestCase
{
    private Link|MockObject $component;

    protected function setUp(): void
    {
        $this->component = $this->getMockBuilder(Link::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getMock();
    }

    /**
     * @testdox sanitizeHref sanitizes phone numbers and emails
     */
    public function testSanitizeHref()
    {
        $this->assertEquals('tel:1234567890', $this->component->sanitizeHref('tel: 123-456-7890'));
        $this->assertEquals('mailto:test@example.com', $this->component->sanitizeHref('mailto: test@example.com'));
        $this->assertEquals('http://example.com', $this->component->sanitizeHref('http://example.com'));
        $this->assertEquals('', $this->component->sanitizeHref(''));
    }

    /**
     * @testdox sanitizeHref does not remove hyphens from email addresses
     */
    public function testSanitizeHrefDoesNotRemoveHyphensFromEmail()
    {
        $this->assertEquals('mailto:test-email@example.com', $this->component->sanitizeHref('mailto:test-email@example.com'));
    }
}
