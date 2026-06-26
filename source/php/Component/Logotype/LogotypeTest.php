<?php

namespace ComponentLibrary\Component\Logotype;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\TestCase;

class LogotypeTest extends TestCase
{
    public function testMaskableAttributesAreAddedForSvgSource(): void
    {
        $controller = $this->getController([
            'maskable' => true,
            'src' => '/assets/logo.svg',
        ]);

        $data = $controller->getData();

        $this->assertSame('true', $data['attributeList']['data-logotype-maskable']);
        $this->assertSame('/assets/logo.svg', $data['attributeList']['data-logotype-maskable-src']);
        $this->assertContains('c-logotype--is-maskable', $data['classList']);
    }

    public function testMaskableAttributesAreNotAddedForNonSvgSource(): void
    {
        $controller = $this->getController([
            'maskable' => true,
            'src' => '/assets/logo.png',
        ]);

        $data = $controller->getData();

        $this->assertArrayNotHasKey('data-logotype-maskable', $data['attributeList']);
        $this->assertArrayNotHasKey('data-logotype-maskable-src', $data['attributeList']);
        $this->assertNotContains('c-logotype--is-maskable', $data['classList']);
    }

    public function testMaskableAttributesAreAddedForSvgSourceWithQueryString(): void
    {
        $controller = $this->getController([
            'maskable' => true,
            'src' => '/assets/logo.svg?version=1',
        ]);

        $data = $controller->getData();

        $this->assertSame('true', $data['attributeList']['data-logotype-maskable']);
        $this->assertContains('c-logotype--is-maskable', $data['classList']);
    }

    private function getController(array $data = []): Logotype
    {
        return new Logotype(
            $data,
            $this->createMock(CacheInterface::class),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
    }
}
