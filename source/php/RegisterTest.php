<?php

declare(strict_types=1);

namespace ComponentLibrary;

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Component\Button\ButtonData;
use ComponentLibrary\Helper\TagSanitizer;
use HelsingborgStad\BladeService\BladeService;
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    private Register $register;

    protected function setUp(): void
    {
        $this->register = $this->createRegister();
    }

    public function testControllerClassIsResolvedOnlyOnce(): void
    {
        $data = $this->getButtonDefaults();

        $this->register->getControllerArgs($data, 'Button');
        $this->register->getControllerArgs($data, 'Button');

        static::assertSame(1, $this->register->locateControllerCalls);
        static::assertSame(1, $this->register->getNamespaceCalls);
    }

    public function testAddingControllerPathInvalidatesResolvedControllers(): void
    {
        $data = $this->getButtonDefaults();

        $this->register->getControllerArgs($data, 'Button');
        $this->register->addControllerPath(__DIR__ . '/Component');
        $this->register->getControllerArgs($data, 'Button');

        static::assertSame(2, $this->register->locateControllerCalls);
        static::assertSame(2, $this->register->getNamespaceCalls);
    }

    public function testTypedComponentConfigIsPreferredWhenAvailable(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        static::assertSame('string|NULL', $this->register->data->button->argsTypes->href);
        static::assertSame(ButtonData::class, $this->register->data->button->dataClass);
    }

    public function testGetControllerArgsSupportsTypedDataObjects(): void
    {
        $data = $this->register->getControllerArgs(
            new ButtonData(
                text: 'Send',
                href: 'mailto:test@example.com',
                icon: 'mail',
            ),
            'Button',
        );

        static::assertSame('Send', $data['text']);
        static::assertSame('mailto:test@example.com', $data['attributeList']['href']);
        static::assertSame('a', $data['componentElement']);
    }

    public function testGetControllerArgsNormalizesNestedTypedDataObjects(): void
    {
        $data = $this->register->getControllerArgs(
            new \ComponentLibrary\Component\Accordion\AccordionData(
                heading: ['FAQ'],
                list: [
                    new \ComponentLibrary\Component\Accordion\AccordionItemData(
                        heading: 'Question',
                        content: '<p>Answer</p>',
                    ),
                ],
                spacing: true,
            ),
            'Accordion',
        );

        static::assertSame('Question', $data['list'][0]['heading']);
        static::assertSame('<p>Answer</p>', $data['list'][0]['content']);
        static::assertContains('c-accordion--spaced', $data['classList']);
    }

    private function createRegister(): Register
    {
        $componentPath = __DIR__ . '/Component';

        $register = new class(
            new BladeService([$componentPath]),
            new StaticCache(),
            new TagSanitizer(),
        ) extends Register {
            public int $locateControllerCalls = 0;
            public int $getNamespaceCalls = 0;

            public function locateController($controller)
            {
                $this->locateControllerCalls++;
                return parent::locateController($controller);
            }

            public function getNamespace($classPath)
            {
                $this->getNamespaceCalls++;
                return parent::getNamespace($classPath);
            }
        };

        $register->addControllerPath($componentPath);

        return $register;
    }

    private function getButtonDefaults(): array
    {
        $config = json_decode(
            file_get_contents(__DIR__ . '/Component/Button/button.json'),
            true,
        );

        return $config['default'];
    }
}
