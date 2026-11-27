<?php

use ComponentLibrary\Component\BaseController;
use ComponentLibrary\Cache\StaticCache;
use ComponentLibrary\Helper\TagSanitizer;

class BaseControllerFilterNameFixture extends BaseController
{
    public function init(): void {}
}

class BaseControllerTest extends PHPUnit\Framework\TestCase
{
    /** @runInSeparateProcess */
    public function testListsAndStringsStayAlignedThroughFiltersAndRepeatedReads(): void
    {
        if (!function_exists('apply_filters')) {
            eval('function apply_filters($name, $value, ...$args) { return ($GLOBALS["componentTestFilter"])($name, $value); }');
        }
        $GLOBALS['componentTestFilter'] = static function ($name, $value) {
            if ($name === 'ComponentLibrary/Component/Data') {
                $value['class'] = 'from-data-filter';
            }
            if ($name === 'BaseControllerFilterNameFixture/Data') {
                \PHPUnit\Framework\Assert::assertSame(['from-data-filter'], $value['classList']);
                $value['attribute'] = 'data-initial="yes" role="button"';
            }
            if ($name === 'ComponentLibrary/Component/Class') {
                $value[] = 'filtered-class';
                $value[] = 'custom filtered-class';
            }
            if ($name === 'ComponentLibrary/Component/Attribute') {
                $value['title'] = 'A & B';
                $value['ROLE'] = 'duplicate';
            }
            if ($name === 'BaseControllerFilterNameFixture/ClassList') {
                $value[] = 'list-class';
            }
            if ($name === 'BaseControllerFilterNameFixture/Attribute' && is_string($value)) {
                $value .= ' data-extra="hello &amp; goodbye" DATA-EXTRA="duplicate"';
            }
            return $value;
        };

        $controller = new BaseControllerFilterNameFixture(
            ['classList' => ['custom'], 'attributeList' => ['role' => 'button']],
            new StaticCache(),
            new TagSanitizer(),
        );
        $first = $controller->getData();
        $second = $controller->getData();
        self::assertSame($first['classList'], $second['classList']);
        self::assertSame(implode(' ', $first['classList']), $first['class']);
        self::assertContains('from-data-filter', $first['classList']);
        self::assertSame('yes', $first['attributeList']['data-initial']);
        self::assertContains('filtered-class', $first['classList']);
        self::assertSame(1, count(array_keys($first['classList'], 'custom', true)));
        self::assertSame(1, count(array_keys($first['classList'], 'filtered-class', true)));
        self::assertArrayNotHasKey('ROLE', $first['attributeList']);
        self::assertArrayNotHasKey('DATA-EXTRA', $first['attributeList']);
        self::assertContains('list-class', $first['classList']);
        self::assertSame('hello & goodbye', $first['attributeList']['data-extra']);
        self::assertSame('A & B', $first['attributeList']['title']);
        self::assertSame(BaseController::buildAttributes($first['attributeList']), $first['attribute']);
    }

    /** @runInSeparateProcess */
    public function testFilterPipelinesCanBeDisabled(): void
    {
        if (!function_exists('apply_filters')) {
            eval('function apply_filters($name, $value, ...$args) { throw new \RuntimeException("Unexpected filter call"); }');
        }
        $filters = [
            new \ComponentLibrary\Filter\Component\AttributeFilter('Example'),
            new \ComponentLibrary\Filter\Component\ClassFilter('Example', 'c-example', []),
            new \ComponentLibrary\Filter\Component\FieldFilter('Example', static fn($data) => $data),
            new \ComponentLibrary\Filter\Component\DataFilter(
                (new ReflectionClass(BaseControllerFilterNameFixture::class))->newInstanceWithoutConstructor(),
                'Example',
                static fn($data) => $data,
            ),
        ];
        foreach ($filters as $filter) {
            self::assertInstanceOf(\ComponentLibrary\Filter\Component\ComponentFilter::class, $filter);
            self::assertSame(['example'], $filter->apply(['example'], false));
        }
    }

    public function testCreateFilterNameReturnsStableValueForClass()
    {
        $reflection = new ReflectionClass(BaseControllerFilterNameFixture::class);
        $controller = $reflection->newInstanceWithoutConstructor();

        $this->assertSame(
            'BaseControllerFilterNameFixture',
            $controller->createFilterName($controller),
        );
        $this->assertSame(
            $controller->createFilterName($controller),
            $controller->createFilterName($controller),
        );
    }

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
        $this->assertEquals(
            'Object="{&quot;key&quot;:&quot;value&quot;}"',
            BaseController::buildAttributes($attributes),
        );
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

    public function testSlotHasDataHandlesMissingAndUnexpectedSlotValues(): void
    {
        $controller = new BaseControllerFilterNameFixture(
            ['slot' => [], 'aboveContent' => 'Unexpected string'],
            new StaticCache(),
            new TagSanitizer(),
        );

        static::assertFalse($controller->slotHasData('missing'));
        static::assertFalse($controller->slotHasData('slot'));
        static::assertFalse($controller->slotHasData('aboveContent'));
    }
}
