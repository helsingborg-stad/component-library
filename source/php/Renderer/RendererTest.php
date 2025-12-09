<?php

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
}
