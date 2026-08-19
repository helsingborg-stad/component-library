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

    // -------------------------------------------------------------------------
    // aspectRatio — valid values
    // -------------------------------------------------------------------------

    public function testValidNumericAspectRatioIsApplied(): void
    {
        $controller = $this->getController(['aspectRatio' => 1.5]);

        $data = $controller->getData();

        $this->assertStringContainsString('--c-logotype--aspect-ratio: 1.5', $data['attributeList']['style']);
    }

    public function testValidNumericStringAspectRatioIsApplied(): void
    {
        $controller = $this->getController(['aspectRatio' => '4']);

        $data = $controller->getData();

        $this->assertStringContainsString('--c-logotype--aspect-ratio: 4', $data['attributeList']['style']);
    }

    // -------------------------------------------------------------------------
    // aspectRatio — invalid / missing values are ignored
    // -------------------------------------------------------------------------

    public function testMissingAspectRatioProducesNoStyle(): void
    {
        $controller = $this->getController([]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('--c-logotype--aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testZeroAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => 0]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('--c-logotype--aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testNegativeAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => -2]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('--c-logotype--aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testNonNumericStringAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => 'square']);

        $data = $controller->getData();

        $this->assertStringNotContainsString('--c-logotype--aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    // -------------------------------------------------------------------------
    // resolveAspectRatio unit tests
    // -------------------------------------------------------------------------

    /**
     * @dataProvider validAspectRatioProvider
     */
    public function testResolveAspectRatioReturnsStringForValidValues(mixed $input, string $expected): void
    {
        $controller = $this->getController([]);
        $this->assertSame($expected, $controller->resolveAspectRatio($input));
    }

    /**
     * @return array<string, array{mixed, string}>
     */
    public static function validAspectRatioProvider(): array
    {
        return [
            'integer'        => [1, '1'],
            'float'          => [2.5, '2.5'],
            'numeric string' => ['3', '3'],
        ];
    }

    /**
     * @dataProvider invalidAspectRatioProvider
     */
    public function testResolveAspectRatioReturnsNullForInvalidValues(mixed $input): void
    {
        $controller = $this->getController([]);
        $this->assertNull($controller->resolveAspectRatio($input));
    }

    /**
     * @return array<string, array{mixed}>
     */
    public static function invalidAspectRatioProvider(): array
    {
        return [
            'null'        => [null],
            'false'       => [false],
            'empty string'=> [''],
            'zero'        => [0],
            'negative'    => [-1],
            'non-numeric' => ['wide'],
        ];
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
