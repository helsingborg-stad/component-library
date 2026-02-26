<?php

use ComponentLibrary\Cache\CacheInterface;
use ComponentLibrary\Component\BaseController;
use ComponentLibrary\Helper\TagSanitizerInterface;

class BaseControllerTest extends PHPUnit\Framework\TestCase
{
    public function testBuildAttributesReturnsAllAttributesAsString()
    {
        $attributes = ['One' => 'one', 'Two' => 'two'];
        $this->assertEquals('One="one" Two="two"', BaseController::buildAttributes($attributes));
    }

    public function testBuildAttributesAllowsArrayAsValue()
    {
        $attributes = ['One' => ['foo']];
        $this->assertEquals('One="[&quot;foo&quot;]"', BaseController::buildAttributes($attributes));
    }

    public function testBuildAttributesAllowsObjectAsValue()
    {
        $attributes = ['Object' => (object) ['key' => 'value']];
        $this->assertEquals('Object="{&quot;key&quot;:&quot;value&quot;}"', BaseController::buildAttributes($attributes));
    }

    public function testAllowsZeroAsString()
    {
        $attributes = ['Zero' => '0'];
        $this->assertEquals('Zero="0"', BaseController::buildAttributes($attributes));
    }

    public function testAllowsZeroAsInteger()
    {
        $attributes = ['Zero' => 0];
        $this->assertEquals('Zero="0"', BaseController::buildAttributes($attributes));
    }

    public function testAllowsBooleanTrue()
    {
        $attributes = ['Boolean' => true];
        $this->assertEquals('Boolean="1"', BaseController::buildAttributes($attributes));
    }

    public function testAllowsBooleanFalse()
    {
        $attributes = ['Boolean' => false];
        $this->assertEquals('Boolean="0"', BaseController::buildAttributes($attributes));
    }

    public function testDisallowsNull()
    {
        $attributes = ['Null' => null];
        $this->assertEquals('Null=""', BaseController::buildAttributes($attributes));
    }

    public function testDisallowsNullAsString()
    {
        $attributes = ['Null' => 'null'];
        $this->assertEquals('Null=""', BaseController::buildAttributes($attributes));
    }

    public function testIgnoresResources()
    {
        $resource = fopen('php://temp', 'r');
        $attributes = ['Resource' => $resource];
        $this->assertEquals('', BaseController::buildAttributes($attributes));
        fclose($resource);
    }

    public function testIgnoresCallables()
    {
        $attributes = ['Callable' => function () {
            return 'test';
        }];
        $this->assertEquals('', BaseController::buildAttributes($attributes));
    }

    public function testGetDataExposesComponentControllerForViews()
    {
        // Arrange
        $cache = $this->createMock(CacheInterface::class);
        $tagSanitizer = $this->createMock(TagSanitizerInterface::class);
        $controller = new class([], $cache, $tagSanitizer) extends BaseController {
            public function init()
            {
            }
        };

        // Act
        $data = $controller->getData();

        // Assert
        $this->assertArrayHasKey('componentController', $data);
        $this->assertSame($controller, $data['componentController']);
        $this->assertIsString($data['componentController']->getSlug());
        $this->assertNotEmpty($data['componentController']->getSlug());
    }
}
