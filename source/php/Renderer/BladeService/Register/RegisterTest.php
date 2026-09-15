<?php

declare(strict_types=1);

namespace ComponentLibrary\Renderer\BladeService\Register;

use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Helper\TagSanitizer;
use HelsingborgStad\BladeService\BladeService;
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    public function testUntrustedPhpConfigPathIsRejected(): void
    {
        $register = new Register(
            new BladeService([__DIR__ . '/../../../Component']),
            new StaticCache(),
            new TagSanitizer(),
        );

        $componentDirectory = sys_get_temp_dir() . '/component-library-renderer-untrusted-' . uniqid('', true);
        mkdir($componentDirectory, 0777, true);
        $configPath = $componentDirectory . '/config.php';
        file_put_contents($configPath, '<?php return [];');

        $method = (new \ReflectionClass(Register::class))->getMethod('readConfigFile');
        $method->setAccessible(true);

        $this->expectException(\UnexpectedValueException::class);
        $method->invoke($register, $configPath);
    }
}
