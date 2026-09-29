<?php

namespace ComponentLibrary\Component\Icon;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\ComponentConfiguration\ComponentDataReflector;
use ComponentLibrary\Helper\TagSanitizerInterface;
use PHPUnit\Framework\TestCase;

class IconSvgModeTest extends TestCase
{
    public function testSvgModeLoadsASelectedLocalSvgAndKeepsColorAndSizeClasses(): void
    {
        $file = tempnam(sys_get_temp_dir(), 'component-icon-');
        file_put_contents($file, '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M0 0"/></svg>');

        try {
            TestableSvgIcon::$nextSvgPath = $file;
            $icon = new TestableSvgIcon(
                $this->data([
                    'icon' => 'home',
                    'filled' => null,
                    'defaultFilled' => true,
                    'svgMode' => true,
                    'color' => 'primary',
                    'size' => 'md',
                ]),
                $this->emptyIconCache(),
                $this->createMock(TagSanitizerInterface::class),
            );
            $data = $icon->getData();

            static::assertTrue($icon->resolvedFilled);
            static::assertSame(true, $data['filled']);
            static::assertStringContainsString('<svg', $data['svgElementFromFile']);
            static::assertNotEmpty(array_filter($data['classList'], fn($class) => str_ends_with($class, '--svg-path')));
            static::assertNotEmpty(array_filter($data['classList'], fn($class) => str_ends_with($class, '--color-primary')));
            static::assertNotEmpty(array_filter($data['classList'], fn($class) => str_ends_with($class, '--size-md')));
            static::assertNotContains('material-symbols', $data['classList']);
        } finally {
            TestableSvgIcon::$nextSvgPath = null;
            unlink($file);
        }
    }

    public function testMissingSvgFallsBackToFont(): void
    {
        TestableSvgIcon::$nextSvgPath = null;
        $icon = new TestableSvgIcon(
            $this->data(['icon' => 'home', 'filled' => false, 'svgMode' => true]),
            $this->emptyIconCache(),
            $this->createMock(TagSanitizerInterface::class),
        );

        static::assertContains('material-symbols', $icon->getData()['classList']);
    }

    private function emptyIconCache(): CacheInterface
    {
        $cache = $this->createMock(CacheInterface::class);
        $cache->method('get')->willReturn([]);
        return $cache;
    }

    private function data(array $values): array
    {
        return array_merge((new ComponentDataReflector())->getDefaultArguments(IconData::class), $values);
    }
}

class TestableSvgIcon extends Icon
{
    public static ?string $nextSvgPath = null;
    public ?bool $resolvedFilled = null;

    protected function resolveSvgPath(string $icon, bool $filled)
    {
        $this->resolvedFilled = $filled;
        return self::$nextSvgPath;
    }
}
