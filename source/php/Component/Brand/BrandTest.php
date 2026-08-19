<?php

namespace ComponentLibrary\Component\Brand;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    // -------------------------------------------------------------------------
    // Legacy scenarios — existing rendering behaviour must be unchanged
    // -------------------------------------------------------------------------

    public function testLogoWithOneTextRowRendersWithoutAspectRatioStyle(): void
    {
        $controller = $this->getController([
            'logotype' => ['src' => '/logo.svg'],
            'text' => ['Acme Corp'],
        ]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testLogoWithMultipleTextRowsRendersWithoutAspectRatioStyle(): void
    {
        $controller = $this->getController([
            'logotype' => ['src' => '/logo.svg'],
            'text' => ['Acme Corp', 'Tagline'],
        ]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testOnlyLogotypeRendersWithoutAspectRatioStyle(): void
    {
        $controller = $this->getController([
            'logotype' => ['src' => '/logo.svg'],
            'text' => [],
        ]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testOnlyTextRendersWithoutAspectRatioStyle(): void
    {
        $controller = $this->getController([
            'logotype' => [],
            'text' => ['Acme Corp'],
        ]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    // -------------------------------------------------------------------------
    // aspectRatio — valid values
    // -------------------------------------------------------------------------

    public function testValidNumericAspectRatioIsApplied(): void
    {
        $controller = $this->getController([
            'aspectRatio' => 2.5,
        ]);

        $data = $controller->getData();

        $this->assertStringContainsString('aspect-ratio: 2.5', $data['attributeList']['style']);
    }

    public function testValidNumericStringAspectRatioIsApplied(): void
    {
        $controller = $this->getController([
            'aspectRatio' => '3',
        ]);

        $data = $controller->getData();

        $this->assertStringContainsString('aspect-ratio: 3', $data['attributeList']['style']);
    }

    // -------------------------------------------------------------------------
    // aspectRatio — invalid / missing values are ignored
    // -------------------------------------------------------------------------

    public function testMissingAspectRatioProducesNoStyle(): void
    {
        $controller = $this->getController([]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testFalseAspectRatioProducesNoStyle(): void
    {
        $controller = $this->getController(['aspectRatio' => false]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testZeroAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => 0]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testNegativeAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => -1]);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testNonNumericStringAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => 'wide']);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
    }

    public function testEmptyStringAspectRatioIsIgnored(): void
    {
        $controller = $this->getController(['aspectRatio' => '']);

        $data = $controller->getData();

        $this->assertStringNotContainsString('aspect-ratio', (string) ($data['attributeList']['style'] ?? ''));
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
            'float'          => [1.5, '1.5'],
            'numeric string' => ['2', '2'],
            'small float'    => [0.1, '0.1'],
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
            'null'           => [null],
            'false'          => [false],
            'empty string'   => [''],
            'zero'           => [0],
            'negative'       => [-1],
            'non-numeric'    => ['wide'],
        ];
    }

    // -------------------------------------------------------------------------
    // Helper
    // -------------------------------------------------------------------------

    private function getController(array $data = []): Brand
    {
        return new Brand(
            $data,
            $this->createMock(CacheInterface::class),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
    }
}
