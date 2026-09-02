<?php

declare(strict_types=1);

namespace ComponentLibrary;

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Helper\TagSanitizer;
use HelsingborgStad\BladeService\BladeService;
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    public function testControllerClassIsResolvedOnlyOnce(): void
    {
        $register = $this->createRegister();
        $data = $this->getButtonDefaults();

        $register->getControllerArgs($data, 'Button');
        $register->getControllerArgs($data, 'Button');

        static::assertSame(1, $register->locateControllerCalls);
        static::assertSame(1, $register->getNamespaceCalls);
    }

    public function testAddingControllerPathInvalidatesResolvedControllers(): void
    {
        $register = $this->createRegister();
        $data = $this->getButtonDefaults();

        $register->getControllerArgs($data, 'Button');
        $register->addControllerPath(__DIR__ . '/Component');
        $register->getControllerArgs($data, 'Button');

        static::assertSame(2, $register->locateControllerCalls);
        static::assertSame(2, $register->getNamespaceCalls);
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
