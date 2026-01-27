<?php

namespace ComponentLibrary\Component\Fileinput;

use ComponentLibrary\Cache\CacheInterface;
use PHPUnit\Framework\TestCase;

class FileinputTest extends TestCase
{
    /**
     * @testdox can be instantiated
     */
    public function testCanBeInstantiated()
    {
        $cache = static::createCache();
        $tagSanitizer = static::createTagSanitizer();
        $fileinput = new Fileinput(static::getData(), $cache, $tagSanitizer);
        $this->assertInstanceOf(Fileinput::class, $fileinput);
    }

    /**
     * @testdox sets max number of files if provided
     */
    public function testSetsMaxNumberOfFilesIfProvided()
    {
        $cache = static::createCache();
        $tagSanitizer = static::createTagSanitizer();
        $fileinput = new Fileinput(static::getData(['filesMax' => 3]), $cache, $tagSanitizer);

        $resultData = $fileinput->getData();

        static::assertSame(3, $resultData['attributeList']['data-js-file-max']);
    }

    /**
     * @testdox sets min number of files if provided
     */
    public function testSetsMinNumberOfFilesIfProvided()
    {
        $cache = static::createCache();
        $tagSanitizer = static::createTagSanitizer();
        $fileinput = new Fileinput(static::getData(['filesMin' => 3, 'filesMax' => 5]), $cache, $tagSanitizer);

        $resultData = $fileinput->getData();

        static::assertSame(3, $resultData['attributeList']['data-js-file-min']);
    }

    /**
     * @testdox Throws error if min number of files is negative
     */
    public function testThrowsErrorIfMinNumberOfFilesIsNegative()
    {
        static::expectException(\TypeError::class);

        $cache = static::createCache();
        $tagSanitizer = static::createTagSanitizer();
        new Fileinput(static::getData(['filesMin' => -1]), $cache, $tagSanitizer);
    }

    /**
     * @testdox Throws error if min number of files greater than max number of files
     */
    public function testThrowsErrorIfMinNumberOfFilesGreaterThanMaxNumberOfFiles()
    {
        static::expectException(\TypeError::class);

        $cache = static::createCache();
        $tagSanitizer = static::createTagSanitizer();
        new Fileinput(static::getData(['filesMin' => 5, 'filesMax' => 3]), $cache, $tagSanitizer);
    }

    /**
     * @testdox Throws error if min number is not an integer
     */
    public function testThrowsErrorIfMinNumberIsNotAnInteger()
    {
        static::expectException(\TypeError::class);

        $cache = static::createCache();
        $tagSanitizer = static::createTagSanitizer();
        new Fileinput(static::getData(['filesMin' => 'string']), $cache, $tagSanitizer);
    }

    private static function getData(array $merge = []): array
    {
        $jsonFile = __DIR__ . '/fileinput.json';
        $decodedJson = json_decode(file_get_contents($jsonFile), true);
        $defaultData = $decodedJson['default'] ?? [];

        return array_merge($defaultData, $merge);
    }

    private static function createCache(): CacheInterface
    {
        return new class implements CacheInterface {
            public function get(string $key, null|string $group = null): mixed
            {
                return null;
            }

            public function set(string $key, mixed $data, null|string $group = null): void
            {
            }
        };
    }

    private static function createTagSanitizer(): \ComponentLibrary\Helper\TagSanitizerInterface
    {
        return new class implements \ComponentLibrary\Helper\TagSanitizerInterface {
            public function removeATags(string $string): string
            {
                return strip_tags($string, '<a>');
            }
        };
    }
}
