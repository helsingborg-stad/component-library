<?php

declare(strict_types=1);

namespace ComponentLibrary\Assets;

use PHPUnit\Framework\TestCase;

class PhpAssetEnqueuerTest extends TestCase
{
    public function testComponentDependenciesAndManualAssetsAreDeduplicated(): void
    {
        $assets = new PhpAssetEnqueuer();
        $assets->registerComponent('icon', '/icon.css');
        $assets->registerComponent('button', '/button.css', '/button.js');
        $assets->enqueueStyle('base', '/base.css');
        $assets->enqueueComponent('button', ['sass' => ['components' => ['icon']]]);
        $assets->enqueueComponent('button', ['sass' => ['components' => ['icon']]]);
        $assets->enqueueScript('extra', '/extra.js');

        self::assertSame(1, substr_count($assets->renderStyles(), '/button.css'));
        self::assertSame(1, substr_count($assets->renderStyles(), '/icon.css'));
        self::assertSame(1, substr_count($assets->renderScripts(), '/button.js'));
        self::assertStringContainsString('/extra.js', $assets->renderScripts());
        self::assertLessThan(strpos($assets->renderStyles(), '/button.css'), strpos($assets->renderStyles(), '/icon.css'));
    }

    public function testUrlsAreEscapedInHtml(): void
    {
        $assets = new PhpAssetEnqueuer();
        $assets->enqueueStyle('test', '/a.css?x=1&y="2"');

        self::assertStringContainsString('/a.css?x=1&amp;y=&quot;2&quot;', $assets->renderStyles());
    }

    public function testUtilitiesFollowOriginalCascadeOrderEvenWhenDiscoveredOutOfOrder(): void
    {
        $assets = new PhpAssetEnqueuer();
        $assets->registerUtility('spacing', '/spacing.css', 2);
        $assets->registerUtility('display', '/display.css', 1);
        $assets->enqueueUtility('spacing');
        $assets->enqueueUtility('display');
        $assets->enqueueUtility('spacing');

        self::assertSame(1, substr_count($assets->renderStyles(), '/spacing.css'));
        self::assertLessThan(strpos($assets->renderStyles(), '/spacing.css'), strpos($assets->renderStyles(), '/display.css'));
    }

    public function testDifferentHandlesWithTheSameUrlOnlyPrintOnce(): void
    {
        $assets = new PhpAssetEnqueuer();
        $assets->enqueueStyle('first', '/shared.css');
        $assets->enqueueStyle('second', '/shared.css');
        $assets->enqueueScript('first', '/shared.js');
        $assets->enqueueScript('second', '/shared.js');

        self::assertSame(1, substr_count($assets->renderStyles(), '/shared.css'));
        self::assertSame(1, substr_count($assets->renderScripts(), '/shared.js'));
    }

    public function testComponentUtilityDependencyIsIncludedOnce(): void
    {
        $assets = new PhpAssetEnqueuer();
        $assets->registerComponent('modal', '/modal.css', '/modal.js');
        $assets->registerUtility('overflow', '/overflow.css');
        $assets->enqueueComponent('modal', ['utilities' => ['overflow']]);
        $assets->enqueueComponent('modal', ['utilities' => ['overflow']]);

        self::assertSame(1, substr_count($assets->renderStyles(), '/overflow.css'));
        self::assertSame(1, substr_count($assets->renderStyles(), '/modal.css'));
        self::assertSame(1, substr_count($assets->renderScripts(), '/modal.js'));
    }
}
