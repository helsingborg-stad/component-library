<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer;

use ComponentLibrary\Component\Accordion\AccordionData;
use ComponentLibrary\Component\Accordion\AccordionItemData;
use ComponentLibrary\Component\Button\ButtonData;
use ComponentLibrary\Renderer\BladeService\BladeServiceFactory;
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

        $this->expectException(\InvalidArgumentException::class);
        $renderer->render('non_existent_view', []);
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

    /**
     * @testdox it renders a migrated component from a typed data object
     */
    public function testRenderTypedButtonComponent(): void
    {
        $bladeServiceFactory = new BladeServiceFactory();
        $bladeService = $bladeServiceFactory->create([__DIR__ . '/views']);
        $renderer = new Renderer($bladeService);

        $output = $renderer->render('typed-button', [
            'button' => new ButtonData(
                text: 'Read more',
                href: 'mailto:test@example.com',
            ),
        ]);

        static::assertStringContainsString('Read more', $output);
        static::assertStringContainsString('href="mailto:test@example.com"', $output);
    }

    /**
     * @testdox it renders nested typed accordion data through the existing array-based views
     */
    public function testRenderTypedAccordionComponent(): void
    {
        $bladeServiceFactory = new BladeServiceFactory();
        $bladeService = $bladeServiceFactory->create([__DIR__ . '/views']);
        $renderer = new Renderer($bladeService);

        $output = $renderer->render('typed-accordion', [
            'accordion' => new AccordionData(
                heading: ['FAQ'],
                list: [
                    new AccordionItemData(
                        heading: 'Question',
                        content: '<p>Answer</p>',
                    ),
                ],
                spacing: true,
            ),
        ]);

        static::assertStringContainsString('Question', $output);
        static::assertStringContainsString('<p>Answer</p>', $output);
        static::assertStringContainsString('c-accordion--spaced', $output);
    }

    /**
     * @testdox it keeps legacy array rendering for migrated components
     */
    public function testRenderMigratedComponentWithLegacyArrayData(): void
    {
        $bladeServiceFactory = new BladeServiceFactory();
        $bladeService = $bladeServiceFactory->create([__DIR__ . '/views']);
        $renderer = new Renderer($bladeService);

        $output = $renderer->render('typed-button', [
            'button' => [
                'text' => 'Legacy',
                'href' => 'https://example.com',
            ],
        ]);

        static::assertStringContainsString('Legacy', $output);
        static::assertStringContainsString('href="https://example.com"', $output);
    }
}
