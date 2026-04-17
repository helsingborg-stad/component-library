<?php

namespace ComponentLibrary\Component\Scope;

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Helper\TagSanitizerInterface;
use Illuminate\Support\HtmlString;
use PHPUnit\Framework\TestCase;

class ScopeTest extends TestCase
{
    /**
     * @testdox data['applyScope'] is a callable that takes an HtmlString and returns an HtmlString
     */
    public function testApplyScopeIsCallable()
    {
        $scope = new Scope(['name' => ''], static::createCacheService(), static::createTagSanitizerService());
        $scope->init();

        $this->assertIsCallable($scope->getData()['applyScope']);
        $result = call_user_func($scope->getData()['applyScope'], new HtmlString('<p>Test</p>'));
        $this->assertInstanceOf(HtmlString::class, $result);
    }

    /**
     * @testdox if name is empty, applyScope should return the inner HtmlString unchanged
     */
    public function testApplyScopeWithEmptyName()
    {
        $scope = new Scope(['name' => ''], static::createCacheService(), static::createTagSanitizerService());
        $scope->init();

        $applyScope = $scope->getData()['applyScope'];
        $input = new HtmlString('<p>Test</p>');
        $output = call_user_func($applyScope, $input);

        $this->assertEquals($input->toHtml(), $output->toHtml());
    }

    /**
     * @testdox if name is a string, applyScope should add the correct data-scope attribute to direct children
     */
    public function testApplyScopeWithStringName()
    {
        $scope = new Scope(['name' => 'example'], static::createCacheService(), static::createTagSanitizerService());
        $scope->init();

        $applyScope = $scope->getData()['applyScope'];
        $input = new HtmlString('<div><p>Test</p><span>Another</span></div>');
        $output = call_user_func($applyScope, $input);

        $expected = '<div data-scope="s-example;"><p>Test</p><span>Another</span></div>';
        $this->assertEquals($expected, $output->toHtml());
    }

    /**
     * @testdox if name is an array, applyScope should add the correct data-scope attribute with all scopes to direct children
     */
    public function testApplyScopeWithArrayName()
    {
        $scope = new Scope(['name' => ['example1', 'example2']], static::createCacheService(), static::createTagSanitizerService());
        $scope->init();

        $applyScope = $scope->getData()['applyScope'];
        $input = new HtmlString('<div><p>Test</p><span>Another</span></div>');
        $output = call_user_func($applyScope, $input);

        $expected = '<div data-scope="s-example1; s-example2;"><p>Test</p><span>Another</span></div>';
        $this->assertEquals($expected, $output->toHtml());
    }

    private static function createCacheService(): CacheInterface
    {
        return new class implements CacheInterface {
            public function get(string $key, ?string $group = null): mixed
            {
                throw new \Exception('Not implemented');
            }

            public function set(string $key, mixed $data, ?string $group = null): void
            {
                throw new \Exception('Not implemented');
            }
        };
    }

    private static function createTagSanitizerService(): TagSanitizerInterface
    {
        return new class implements TagSanitizerInterface {
            public function removeATags(string $string): string
            {
                throw new \Exception('Not implemented');
            }
        };
    }
}
