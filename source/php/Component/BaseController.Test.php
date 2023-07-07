<?php

use ComponentLibrary\Component\BaseController;

class BaseControllerTest extends PHPUnit\Framework\TestCase
{
    public function testBuildAttributesReturnsAllAttributesAsString()
    {
        $attributes = ['One' => 'one', 'Two' => 'two'];
        $this->assertEquals('One="one" Two="two"', BaseController::buildAttributes($attributes));
    }

    public function testBuildAttributesOnlyHandlesAttributeStringValues()
    {
        $attributes = ['One' => ['foo']];
        $this->assertEquals('', BaseController::buildAttributes($attributes));
    }
}
