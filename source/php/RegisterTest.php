<?php

declare(strict_types=1);

namespace ComponentLibrary;

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Component\Avatar\AvatarData;
use ComponentLibrary\Component\Button\ButtonData;
use ComponentLibrary\Component\Brand\BrandData;
use ComponentLibrary\Component\Notice\NoticeData;
use ComponentLibrary\Component\Fab\FabData;
use ComponentLibrary\Component\Box\BoxData;
use ComponentLibrary\Helper\TagSanitizer;
use HelsingborgStad\BladeService\BladeService;
use Illuminate\Support\HtmlString;
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

    public function testBrandUsesItsTypedComponentConfig(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        static::assertSame('string|integer|double|boolean', $this->register->data->brand->argsTypes->aspectRatio);
        static::assertSame(BrandData::class, $this->register->data->brand->dataClass);
    }
  
    public function testBoxUsesItsTypedComponentConfig(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        static::assertSame('ComponentLibrary\\Integrations\\Image\\ImageInterface|boolean|array', $this->register->data->box->argsTypes->image);
        static::assertSame(BoxData::class, $this->register->data->box->dataClass);
    }

    public function testAvatarUsesItsTypedComponentConfig(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        static::assertSame('ComponentLibrary\\Integrations\\Image\\ImageInterface|string|boolean', $this->register->data->avatar->argsTypes->image);
        static::assertSame(AvatarData::class, $this->register->data->avatar->dataClass);
    }

    public function testTypedComponentConfigPreservesLegacyMetadataShapes(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        static::assertTrue(property_exists($this->register->data->group->argsTypes, 'justifyContent'));
        static::assertTrue(property_exists($this->register->data->group->argsTypes, 'jusitifyContent'));
        static::assertSame('integer|boolean', $this->register->data->field->argsTypes->multiline);
        static::assertSame('string|integer|NULL', $this->register->data->fileinput->argsTypes->maxSize);
        static::assertSame('string|boolean', $this->register->data->date->argsTypes->action);
        static::assertSame('string|boolean', $this->register->data->hero->argsTypes->animation);
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

    public function testGetControllerArgsPreservesFabHtmlStringSlot(): void
    {
        $slot = new HtmlString('<p>Actions</p>');

        $data = $this->register->getControllerArgs(
            new FabData(slot: $slot),
            'Fab',
        );

        static::assertSame($slot, $data['slot']);
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

    public function testGetControllerArgsSupportsExplicitTypedMetadataForLegacyArrays(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        $data = $this->register->getControllerArgs(
            [
                'heading' => ['FAQ'],
                'list' => [
                    new \ComponentLibrary\Component\Accordion\AccordionItemData(
                        heading: 'Question',
                        content: '<p>Answer</p>',
                    ),
                ],
                'spacing' => true,
            ],
            'Accordion',
            $this->register->data->accordion->dataClass,
        );

        static::assertSame('Question', $data['list'][0]['heading']);
        static::assertSame('<p>Answer</p>', $data['list'][0]['content']);
    }

    public function testTypedNoticeConfigPreservesLegacyUnionTypes(): void
    {
        $this->register->registerInternalComponents(__DIR__ . '/Component');

        static::assertEqualsCanonicalizing(
            ['object', 'array'],
            explode('|', $this->register->data->notice->argsTypes->message),
        );
        static::assertEqualsCanonicalizing(
            ['boolean', 'string'],
            explode('|', $this->register->data->notice->argsTypes->dismissable),
        );
    }

    public function testGetControllerArgsSupportsTypedNoticeLegacyInputs(): void
    {
        $data = $this->register->getControllerArgs(
            new NoticeData(
                message: (object) ['title' => 'Title', 'message' => 'Message'],
                dismissable: 'permanent',
            ),
            'Notice',
        );

        static::assertSame('Title', $data['message']['title']);
        static::assertSame('Message', $data['message']['message']);
        static::assertTrue($data['attributeList']['data-dismissable-notice']);
        static::assertSame('permanent', $data['attributeList']['data-dismissable-notice-timeout']);
    }

    public function testUntrustedPhpConfigPathIsRejected(): void
    {
        $componentDirectory = sys_get_temp_dir() . '/component-library-untrusted-' . uniqid('', true);
        mkdir($componentDirectory, 0777, true);
        $configPath = $componentDirectory . '/config.php';
        file_put_contents($configPath, '<?php return [];');

        $method = (new \ReflectionClass(Register::class))->getMethod('readConfigFile');
        $method->setAccessible(true);

        $this->expectException(\UnexpectedValueException::class);
        $method->invoke($this->register, $configPath);
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
