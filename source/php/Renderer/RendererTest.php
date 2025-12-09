<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

use ComponentLibrary\Renderer\BladeEngine\BladeServiceFactory;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    /**
     * @testdox it should render a view with given data
     */
    public function testRenderView()
    {
        $bladeServiceFactory = new BladeServiceFactory();
        $bladeService = $bladeServiceFactory->create([__DIR__ . '/views']);
        $renderer = new Renderer($bladeService);

        $output = $renderer->render('test', ['name' => 'World']);

        static::assertSame('Hello World!', trim($output));
    }

    /**
     * @testdox throws error if view does not exist
     */
    public function testRenderNonExistentViewThrowsError()
    {
        $bladeServiceFactory = new BladeServiceFactory();
        $bladeService = $bladeServiceFactory->create([__DIR__ . '/views']);
        $renderer = new Renderer($bladeService);

        try {
            $renderer->render('non_existent_view', []);
        } catch (\Throwable $e) {
            static::assertInstanceOf(\InvalidArgumentException::class, $e);
            return;
        }

        static::fail('Expected exception was not thrown.');
    }

    /**
     * @testdox WP_DEBUG true should print error instead of throwing
     */
    public function testWpDebugTruePrintsError()
    {
        define('WP_DEBUG', true);

        $bladeServiceFactory = new BladeServiceFactory();
        $bladeService = $bladeServiceFactory->create([__DIR__ . '/views']);
        $renderer = new Renderer($bladeService);

        ob_start();
        $renderer->render('non_existent_view', []);
        $output = ob_get_clean();

        static::assertStringContainsString('View [non_existent_view] not found', $output);
    }
}
